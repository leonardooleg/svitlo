<?php

namespace App\Listeners;

use App\Events\NewUserRegister;
use GuzzleHttp\Client;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Hash;

class NotificationNewUser
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {

        $user = $event->user;
        $userName = $user->name;
        $this->telegram_notification($userName);
        // Send a message to telegram
        $token = config('services.telegram.token');
        $apiUrl = 'https://api.telegram.org/bot' .$token . '/';

        // Save the username in the database
        $message = "Новий користувач '".$userName;
        file_put_contents('new_user_log.txt', $message, FILE_APPEND);
        $client = new Client();
        $sendMessageData = [
            'chat_id' => 182672925,
            'text' => $message,
        ];

        $sendMessageUrl = $apiUrl . 'sendMessage';
        $response = $client->post($sendMessageUrl, ['form_params' => $sendMessageData]);
    }
}
