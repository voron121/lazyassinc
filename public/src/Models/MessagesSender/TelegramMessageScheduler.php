<?php

namespace App\Models\MessagesSender;

use App\Config;
use App\Memcached;

class TelegramMessageScheduler extends Sender
{

    public function execute(): void
    {
        $schedulerParams = $this->messages->getSchedulerParams();
        $memcached = Memcached::getInstance();
        $scheduledQueue = $memcached->get(Config::get('messagesScheduledQueue')) ?: [];

        $scheduledQueue[$schedulerParams['date']][$schedulerParams['time']] = $this->telegramMessageGenerator->getMessage();
        $memcached->set(Config::get('messagesScheduledQueue'), $scheduledQueue);
        SenderResponse::setResponse(
            'success',
            ['status' => 'success', 'message' => 'The message is scheduled for delivery on ' . $schedulerParams['date'] . ' at ' . $schedulerParams['time']]
        );
    }
}