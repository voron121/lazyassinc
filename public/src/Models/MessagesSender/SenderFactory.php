<?php

namespace App\Models\MessagesSender;

use App\Models\Messages;

class SenderFactory
{
    /**
     * Creates a sender object based on the given messages object.
     *
     * @param Messages $messages The messages object to create the sender from.
     * @return Sender A sender object.
     */
    public static function make(Messages $messages): Sender
    {
        if ($messages->isScheduled()) {
            return new TelegramMessageScheduler($messages);
        } else {
            return new TelegramMessageSender($messages);
        }
    }
}