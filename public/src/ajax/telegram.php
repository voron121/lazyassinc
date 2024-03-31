<?php
error_reporting(0);

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Config;
use \TelegramBot\Api\BotApi;
use App\Models\TelegramMessageGenerator;

/**
 * Simple ajax handler to processing ajax query
 * for sending message into telegram channel by button click
 *
 * Useful links:
 * https://packagist.org/packages/telegram-bot/api
 * https://api.telegram.org/bot<BOT_TOKEN>/getUpdates
 * https://core.telegram.org/bots/api#formatting-options
 */

try {
    $response = ['status' => 'error', 'message' => ''];
    $bot = new BotApi(Config::get('telegramBotToken'));
    $message = (new TelegramMessageGenerator($_POST))->getMessage();
    $bot->sendMessage(Config::get('telegramChatId'), $message, 'HTML');
    $response['status'] = 'success';
    $response['message'] = 'Message successfully sent!';
    echo json_encode($response);
    exit;
} catch (\Throwable $throwable) {
    $response['message'] = $throwable->getMessage();
    echo json_encode($response);
    exit;
}
