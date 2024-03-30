<?php

namespace App\Models;

/**
 * Simple wrapper to create message for telegram in HTML format
 */
class TelegramMessageGenerator
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Will return whole formatted message
     * @return string
     */
    public function getMessage(): string
    {
        $message = '';
        foreach ($this->data as $item) {
            $message .= '<b>' . $item['dayTitle'] . '</b>' . PHP_EOL . PHP_EOL;
            $message .= $this->getMessagesSnippets($item['messages']);
        }
        $message .= PHP_EOL;
        return $message;
    }

    /**
     * @param array $messages
     * @return string
     */
    private function getMessagesSnippets(array $messages): string
    {
        $snippets = '';
        foreach ($messages as $message) {
            if (isset($message['id'])) {
                $snippets .= '<a href="' . $message['url'] .'">' . $message['name'] . '</a>'. PHP_EOL;
            }
            $snippets .= $message['comment'] . PHP_EOL . PHP_EOL;
        }
        return $snippets;
    }
}