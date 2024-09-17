<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Firebase\Exception\MessagingException;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;

class NotificationController extends Controller
{
  protected $messaging;

  public function __construct(Messaging $messaging)
  {
    $this->messaging = $messaging;
  }

  /**
   * @throws MessagingException
   * @throws FirebaseException
   */
  public function sendNotification()
  {
    $factory = (new Factory)->withServiceAccount(storage_path('app/firebase/dev-naporoge-34683983dfb4.json'));
    $messaging = $factory->createMessaging();

    $deviceToken = 'cUoPAhikT_6MqQMatatkdU:APA91bEmOm_uk3FrxErsvvVB45rKcwvXwDZQD6rur_0FyRE_d3QojPTijibgsnCuZyXd8TUndKQgJGMZMup48M1RlWE56wJKdI1IGTUikisElUqIsgqobIQ5CW06Y-G4SgdgAKqYrq0g';

    $message = CloudMessage::fromArray([
      'token' => $deviceToken,
      'notification' => [
        'title' => '123 Hello World',
        'body' => '432 Here is a notification from Laravel',
        'icon' => '@mipmap/ic_launcher_round_notifs' // Указываем имя иконки без расширения файла
      ],
      'android' => [
        'notification' => [
          'icon' => '@mipmap/ic_launcher_round_notifs', // Указываем имя иконки для Android уведомлений
//          'color' => '#f45342' // Например, цвет фона иконки
        ]
      ]
    ]);

    $messaging->send($message);
    return response()->json(['message5' => 'Notification sent successfully']);
  }
}
