<?php

namespace App\Models\MessagesSender;

use App\Models\Messages;
use App\Models\TelegramMessageGenerator;

abstract class Sender
{
    protected TelegramMessageGenerator $telegramMessageGenerator;

    public function __construct(Messages $messages)
    {
        $this->telegramMessageGenerator = new TelegramMessageGenerator($messages->getMessages());
    }

    abstract public function execute(): void;
}