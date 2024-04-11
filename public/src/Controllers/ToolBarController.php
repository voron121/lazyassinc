<?php

namespace App\Controllers;

use App\Config;
use App\Memcached;

/**
 * Class ToolBarController
 * Represents a controller for the toolbar in a Symfony application.
 */
class ToolBarController
{
    private \Memcached $memcached;

    private array $scheduledMessages;

    public function __construct()
    {
        $this->memcached = Memcached::getInstance();
        $this->scheduledMessages = $this->memcached->get(Config::get('messagesScheduledQueue')) ?: [];
    }

    /**
     * Get the count of scheduled messages.
     *
     * @return int The count of scheduled messages.
     */
    public function getScheduledMessagesCount(): int
    {
        return array_reduce($this->scheduledMessages, static function ($carry, $messages) {
            return $carry + count($messages);
        }, 0);
    }

    /**
     * Get the count of scheduled messages for today.
     *
     * @return int The count of scheduled messages for today.
     */
    public function getTodayScheduledMessagesCount(): int
    {
        if (!isset($this->scheduledMessages[date('Y-m-d')])) {
            return 0;
        }
        $messagesForToday = $this->scheduledMessages[date('Y-m-d')];
        return $messagesForToday ? count($messagesForToday) : 0;
    }

    /**
     * Get the count of not sent messages.
     *
     * @return int The count of not sent messages.
     */
    public function getNotSentMessagesCount(): int
    {
        $todayDate = date('Y-m-d');
        $messagesNotSent = array_filter($this->scheduledMessages, static function($messageScheduleDate) use ($todayDate) {
            return strtotime($todayDate) > strtotime($messageScheduleDate);
        }, ARRAY_FILTER_USE_KEY);
        return !empty($messagesNotSent) ? count($messagesNotSent) : 0;
    }
}