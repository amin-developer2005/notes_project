<?php
/**
 * Created by PhpStorm.
 * User: mohammadAmin
 * Date: 2/15/2025
 * @author: Mohammadamin Meghdadi
 * @email: mohamadamin.meghdadi@gmail.com
 * @website: https://amin-developer.ir
 * @link: https://github.com/amin-developer2005
 */


namespace App\Controllers;

class MessageController
{
    private array $messages = [];


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