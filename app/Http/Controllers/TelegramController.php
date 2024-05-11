<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class TelegramController extends Controller
{
    private $botToken;
    private $apiUrl;

    public function __construct()
    {
        $this->botToken = config('services.telegram.token');
        $this->apiUrl = 'https://api.telegram.org/bot' . $this->botToken . '/';
    }

    public function handle(Request $request)
    {
        $updates = json_decode($request->getContent(), true);
        //save to file array
        //file_put_contents('telegram.log', "\n".print_r($updates, true)."\n", FILE_APPEND);
        if (isset($updates['message'])) {
                $chatId = $updates['message']['chat']['id'];
                $text = $updates['message']['text'];
                switch ($text) {
                    case "Головна":
                    case "/start":
                        $this->sendStartMessage($chatId);
                        break;
                    case 'Отримати свій ID':
                        $this->sendUserIdMessage($chatId);
                        break;
                    case 'Отримувати сповіщення':
                        $this->sendStartNotification($chatId);
                        break;
                    case 'Відправити свій Email':
                        //$this->handleSendEmail($chatId,$text);
                        break;
                    default:
                        // Check if $text contains an email address
                        if (filter_var($text, FILTER_VALIDATE_EMAIL)) {
                            $this->handleSendEmail($chatId, $text);
                        } else {
                            $this->sendUnknownCommandMessage($chatId);
                        }
                }
        }

    }

    private function sendStartMessage($chatId)
    {

        $this->sendMessage($chatId, "Вітаю тебе, користувачу з Telegram ID:  `{$chatId}` ! \nВведіть його на сайті в налаштуваннях профілю.");
    }

    private function sendUserIdMessage($chatId)
    {
        $this->sendMessage($chatId, "Ваш Telegram ID: {$chatId}");
    }

    private function handleSendEmail($chatId,$text)
    {
        // Implement logic to receive email address and save it to the database
        // For example, using a keyboard with an input field
        $user = User::where('email', $text)->first();
        if (isset($user)) {
          //update user telegram_id
            $user->telegram_id = $chatId;
            $user->notification = 'telegram';
            $user->save();

            $this->sendMessage($chatId, "Ваша Telegram ID: {$chatId} збережений для електронної пошти: {$text}. Дякуємо!");
        }else{
            $this->sendMessage($chatId, "Такого користувача не знайдено.");
        }

    }
    private function sendStartNotification($chatId)
    {
        // Implement logic to receive email address and save it to the database
        // For example, using a keyboard with an input field
        $user = User::where('telegram_id', $chatId)->first();
        if (isset($user)) {
            $email = $user->email;
          //update user telegram_id
            $user->telegram_id = $chatId;
            $user->notification = 'telegram';
            $user->save();

            $this->sendMessage($chatId, "Ви будете отримувати сповіщення для електронної пошти : {$email}.");
        }else{
            $this->sendMessage($chatId, "Такого користувача не знайдено.");
        }

    }

    private function sendMessage($chatId, $message)
    {
        $keyboard = [
            [['text' => 'Отримати свій ID'], ['text' => 'Відправити свій Email']],
            [['text' => 'Отримувати сповіщення'],['text' => 'Головна']],
        ];

        $replyKeyboardMarkup = [
            'keyboard' => $keyboard,
            'resize_keyboard' => true,
            'one_time_keyboard' => true,
        ];

        $client = new Client();
        $sendMessageData = [
            'chat_id' => $chatId,
            'text' => $message,
        ];

        if ($replyKeyboardMarkup) {
            $sendMessageData['reply_markup'] = json_encode($replyKeyboardMarkup);
        }

        $sendMessageUrl = $this->apiUrl . 'sendMessage';
        $response = $client->post($sendMessageUrl, ['form_params' => $sendMessageData]);

        if (!$response->getStatusCode() === 200) {
            // Handle error sending message
        }
    }

    private function sendUnknownCommandMessage($chatId)
    {
        $this->sendMessage($chatId, "Невідома команда. Використовуйте /start, щоб відкрити головне меню.");
    }
}
