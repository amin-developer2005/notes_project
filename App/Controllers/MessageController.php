<?php

namespace App\Controllers;

class MessageController
{
    private array $messages;


    public function set($message, $field = ''): void
    {
        if ($field != '') {
            $this->messages[] = [
                "{$field}" => $message
            ];
            return;
        }

        $this->messages[] = $message;
    }


    public function getMessages(): ?array
    {
        if (count($this->messages) > 0) {
            return $this->messages;
        }

        return null;
    }
}