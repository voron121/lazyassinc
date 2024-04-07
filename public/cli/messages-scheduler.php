<?php
error_reporting(0);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Config;
use App\Memcached;
use Longman\TelegramBot\Telegram;
use Longman\TelegramBot\Request;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$logger = new Logger('telegramScheduler');
$stream_handler = new StreamHandler(Config::get('logsDir') . 'telegramScheduler.log');
$logger->pushHandler($stream_handler);

try {
    $memcached = Memcached::getInstance();
    $scheduledQueue = $memcached->get(Config::get('messagesScheduledQueue')) ?: [];
    $messagesForSending = $scheduledQueue[date('Y-m-d')];
    if (empty($messagesForSending) || !isset($messagesForSending[date('H:i')])) {
        exit('Nothing to send. Messages queue is empty');
    }

    $message = $messagesForSending[date('H:i')];
    $telegram = new Telegram(Config::get('telegramBotToken'));
    $request = Request::sendMessage([
        'chat_id' => Config::get('telegramChatId'),
        'text' => $message,
        'parse_mode' => 'html'
    ]);
    if (!$request->isOk()) {
        throw new Exception($request->description);
    }

    unset($scheduledQueue[date('Y-m-d')][date('H:i')]);
    $scheduledQueue = $memcached->set(Config::get('messagesScheduledQueue'), $scheduledQueue);
    $logger->info('Message was send successfully!');
    exit('Message was send successfully!');
} catch (Throwable $throwable) {
    $logger->error($throwable->getMessage());
    var_dump($throwable);
}