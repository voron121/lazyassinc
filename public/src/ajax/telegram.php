<?php
error_reporting(0);

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Models\Messages;
use App\Models\MessagesSender\SenderFactory;
use App\Models\MessagesSender\SenderResponse;

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
    $message = new Messages($_POST);
    $sender = SenderFactory::make($message);
    $sender->execute();
    $response = SenderResponse::getResponse('success');
    echo json_encode($response);
    exit;
} catch (\Throwable $throwable) {
    $response['message'] = $throwable->getMessage();
    echo json_encode($response);
    exit;
}
