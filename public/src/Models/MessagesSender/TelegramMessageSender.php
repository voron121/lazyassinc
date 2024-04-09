<?php

namespace App\Models\MessagesSender;

use App\Config;
use Longman\TelegramBot\Telegram;
use Longman\TelegramBot\Request;

class TelegramMessageSender extends Sender
{
    public function execute(): void
    {
        $telegram  = new Telegram(Config::get('telegramBotToken'));
        $request = Request::sendMessage([
            'chat_id' => Config::get('telegramChatId').'ff',
            'text' => $this->telegramMessageGenerator->getMessage(),
            'parse_mode' => 'html'
        ]);
        if (!$request->isOk()) {
            throw new \RuntimeException('Something is gona wrong.');
        }
        SenderResponse::setResponse(
            'success',
            ['status' => 'success', 'message' => 'Message successfully sent!']
        );
    }
}