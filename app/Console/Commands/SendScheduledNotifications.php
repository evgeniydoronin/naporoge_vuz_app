<?php

namespace App\Console\Commands;

use App\Models\User;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use DateTime;
use DateTimeZone;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Throwable;

/**
 * Класс для отправки расписанных уведомлений пользователям.
 */
class SendScheduledNotifications extends Command
{
  /// Определение сигнатуры команды для вызова через CLI
  protected $signature = 'app:send-scheduled-notifications';

  /// Описание команды, отображаемое при вызове help
  protected $description = 'Sends scheduled notifications to users';

  /// Логгер для записи информации о процессе отправки уведомлений
  private $log;

  public function __construct()
  {
    parent::__construct();
    $this->log = Log::channel('scheduled');
  }

  /**
   * Execute the console command.
   * @throws Exception
   */
  public function handle(): void
  {
    $users = $this->getUsers();

    foreach ($users as $user) {
      $this->scheduleNotifications($user);
    }

    $this->info("пользователи для отправки пуша: $users");
  }

  /**
   * Получает список пользователей, которым нужно отправить уведомления.
   * Условия: пользователь должен иметь активный курс и FCM токен.
   */
//  protected function getUsers()
//  {
//    return User::whereHas('streams', function ($query) {
//      $query->where('is_active', 1);
//    }, '=', 1)  // У пользователя должен быть ровно один активный курс
//    ->whereHas('fcmToken')  // У пользователя должен быть FCM токен
//    ->with(['fcmToken', 'streams' => function ($query) {
//      $query->where('is_active', 1);
//    }])
//      ->get()
//      ->map(function ($user) {
//        $stream = $user->streams->first();
//        return (object)[
//          'id' => $user->id,
//          'fcm_token' => $user->fcmToken->token,
//          'timezone' => $user->fcmToken->timezone,
//          'start_at' => $stream ? $stream->start_at : null,
//        ];
//      });
//  }

  protected function getUsers()
  {
    return User::with(['streams', 'fcmToken'])
      ->get()
      ->filter(function ($user) {
        // Убедимся, что у пользователя ровно один курс
        if ($user->streams->count() !== 1) {
          return false;
        }
        // Получим единственный курс пользователя
        $stream = $user->streams->first();
        // Проверим, что курс активен
        if (!$stream->is_active) {
          return false;
        }
        // Убедимся, что у пользователя есть FCM токен
        return $user->fcmToken !== null;
      })
      ->map(function ($user) {
        $stream = $user->streams->first();
        return (object)[
          'id' => $user->id,
          'fcm_token' => $user->fcmToken->token,
          'timezone' => $user->fcmToken->timezone,
          'start_at' => $stream ? $stream->start_at : null,
        ];
      });
  }

  /**
   * Schedule notifications based on user's course start date.
   * @throws Exception
   */
  protected function scheduleNotifications($user): void
  {
    $notifications = $this->getNotifications();

    foreach ($notifications as $notify) {
      $notificationDateTime = $this->calculateNotificationDate($user->start_at, $user->timezone, $notify);
      $currentDateTime = new DateTime("now", new DateTimeZone($user->timezone));
      $currentDateTime->setTime((int)$currentDateTime->format('H'), (int)$currentDateTime->format('i'), 0);
//      $currentDateTime->setTime(0, 0, 0);

      /// Для тестирования
      ///
//      if ($user->id == 615) {
//        $this->sendNotification($user->fcm_token, $notify['message']);
//        $this->log->info("Notification sent: {$notify['message']} to user {$user->id} at {$notificationDateTime->format('Y-m-d H:i:s')}, token: $user->fcm_token");
//        $this->info("Notification sent: {$notify['message']} to user $user->id, at: {$notificationDateTime->format('Y-m-d H:i:s')}, curTime: {$currentDateTime->format('Y-m-d H:i:s')}, start_at: $user->start_at");
//      }

//      if ($user->id == 645) {
//        $this->info("Notification sent: {$notify['message']}, User $user->id, token: $user->fcm_token, notificationDateTime: {$notificationDateTime->format('Y-m-d H:i:s')}, currentDateTime: {$currentDateTime->format('Y-m-d H:i:s')}, start_at: $user->start_at, $user->timezone");
//      }


      // Отправка уведомления и логирование, если время совпадает
      if ($notificationDateTime == $currentDateTime) {

        $this->sendNotification($user->fcm_token, $notify['message']);
        $this->log->info("Notification sent: {$notify['message']} to user $user->id at {$notificationDateTime->format('Y-m-d H:i:s')} token: $user->fcm_token");
        $this->info("Notification sent: {$notify['message']} to user $user->id, token: $user->fcm_token, start_at: $user->start_at");
      }
    }
  }

  /**
   * Define notifications to be sent.
   */
  protected function getNotifications(): array
  {
    return [
      ['daysToAdd' => 0, 'hour' => 18, 'minute' => 45, 'message' => 'Привет! Курс начался, желаем успехов!'],
      ['daysToAdd' => 5, 'hour' => 9, 'minute' => 0, 'message' => 'Появилось 2 новых видео! Что делать, когда не хочу делать дело? Почему откладываются дела?'],
      ['daysToAdd' => 12, 'hour' => 9, 'minute' => 0, 'message' => 'Появилось новое видео: Верное завершение дел'],
      // Additional notifications can be added here.
    ];
  }

  /**
   * Calculate the exact date and time to send notification.
   * @throws Exception
   */
  protected function calculateNotificationDate($startAt, $timezone, $notify): DateTime
  {
    $date = new DateTime($startAt, new DateTimeZone($timezone));
    $date->modify("+{$notify['daysToAdd']} days");
    $date->setTime($notify['hour'], $notify['minute'], 0);
    return $date;
  }

  /**
   * Send notification using Firebase Messaging.
   */
  protected function sendNotification($token, $message): void
  {
    /// DEV
//    $factory = (new Factory)->withServiceAccount(storage_path('app/firebase/dev-naporoge-firebase-adminsdk-kv29g-6374ed9aca.json'));
    /// TODO: ЗАМЕНИТЬ МОЙ АККАУНТ НА КЛИЕНТСКИЙ !!!
    /// PROD
    $factory = (new Factory)->withServiceAccount(storage_path('./app/firebase/naporoge-cf9be-firebase-adminsdk-xgnwe-f03ec6679c.json'));
    $messaging = $factory->createMessaging();

    $message = CloudMessage::fromArray([
      'token' => $token,
      'notification' => [
        'title' => 'Воля',
        'body' => $message,
        'icon' => '@mipmap/ic_launcher_round_notifs'
      ],
      'android' => [
        'notification' => [
          'icon' => '@mipmap/ic_launcher_round_notifs', // Указываем имя иконки для Android уведомлений
          // 'color' => '#f45342' // Например, цвет фона иконки
        ]
      ]
    ]);

    try {
      $messaging->send($message);
    } catch (Throwable $e) {
      $this->log->error("Failed to send notification: {$e->getMessage()}");
    }
  }
}
