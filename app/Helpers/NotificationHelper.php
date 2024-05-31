<?php

namespace App\Helpers;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Mail;

class NotificationHelper
{
    public static function push_notification($user_id, $name, $status): void
    {
        $token = config('services.telegram.token');
        $apiUrl = 'https://api.telegram.org/bot' .$token . '/';
        $user = \App\Models\User::where('id', $user_id)->first();
        $user_notifications = $user->notification;
        $user_notifications_telegram = $user->telegram_id;
        $user_notifications_email = $user->email;

        $message = "Об'єкт '".$name."' - ". $status;

        if ($user_notifications == 'telegram') {

            $client = new Client();
            $sendMessageData = [
                'chat_id' => $user_notifications_telegram,
                'text' => $message,
            ];

            $sendMessageUrl = $apiUrl . 'sendMessage';
            $response = $client->post($sendMessageUrl, ['form_params' => $sendMessageData]);

            if (!$response->getStatusCode() === 200) {
                // Handle error sending message
            }


        }elseif ($user_notifications == 'email') {
            //send email
            $to_name = $user->name;
            $to_email = $user_notifications_email;
            $data = [
                'name' => $to_name,
                'body' => "Дім '" . $name. "' - ". $status,

            ];

              Mail::send('emails.notification', $data, function($message) use ($to_name, $to_email) {
                  $message->to($to_email, $to_name)
                      ->subject('Статус моніторинга світла вдома Svitlo.link');
              });
        }
    }
}
