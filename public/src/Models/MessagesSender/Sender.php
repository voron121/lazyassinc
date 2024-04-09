<?php

namespace App\Models\MessagesSender;

use App\Models\Messages;
use App\Models\TelegramMessageGenerator;

abstract class Sender
{
    protected TelegramMessageGenerator $telegramMessageGenerator;

    public Messages $messages;

    public function __construct(Messages $messages)
    {
        $this->messages = $messages;
        $this->telegramMessageGenerator = new TelegramMessageGenerator($this->messages->getMessages());
    }

    abstract public function execute(): void;
}