<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Firebase\Exception\MessagingException;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;

class SendNotification implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  protected $token;
  protected $message;

  /**
   * Create a new job instance.
   */
  public function __construct($token, $message)
  {
    $this->token = $token;
    $this->message = $message;
  }

  /**
   * Execute the job.
   */
  public function handle(Messaging $messaging): void
  {
    $factory = (new Factory)->withServiceAccount(storage_path('app/firebase/dev-naporoge-34683983dfb4.json'));
    $messaging = $factory->createMessaging();

    $message = CloudMessage::fromArray([
      'token' => $this->token,
      'notification' => [
        'title' => '567 Hello World',
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

  }
}
