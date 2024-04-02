<?php
error_reporting(0);

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Config;
use Longman\TelegramBot\Telegram;
use Longman\TelegramBot\Request;
use App\Models\TelegramMessageGenerator;

/**
 * Simple ajax handler to processing ajax query
 * for sending message into telegram channel by button click
 *
 * Useful links:
 * https://packagist.org/packages/longman/telegram-bot
 * https://api.telegram.org/bot<BOT_TOKEN>/getUpdates
 * https://core.telegram.org/bots/api#formatting-options
 */

try {
    $response = ['status' => 'error', 'message' => ''];
    $message = (new TelegramMessageGenerator($_POST))->getMessage();
    $telegram  = new Telegram(Config::get('telegramBotToken'));
    $request = Request::sendMessage([
        'chat_id' => Config::get('telegramChatId'),
        'text' => $message,
        'parse_mode' => 'html'
    ]);
    if (!$request->isOk()) {
        throw new Exception('Something is gona wrong.');
    }
    $response['status'] = 'success';
    $response['message'] = 'Message successfully sent!';
    echo json_encode($response);
    exit;
} catch (\Throwable $throwable) {
    $response['message'] = $throwable->getMessage();
    echo json_encode($response);
    exit;
}
