<?php

namespace App\System\Traits;

use App\Controllers\MessageController;


trait Validator
{
    public bool $isValid = true {
        set => $this->isValid = $value;
        get => $this->isValid;
    }

    public MessageController $messageController {
        set => $this->messageController = $value;
        get => $this->messageController;
    }



    public function __construct()
    {
        $this->messageController = new MessageController();
    }


    public function validate(): void
    {
        $this->sanitizeData();
        $this->validateNotEmpty(['title' => $this->title, 'body' => $this->body]);

        $this->string('title' , $this->title, 100);
        $this->string('body' , $this->body,  1000);
    }



    public function validateNotEmpty(array $data): void
    {
        foreach ($data as $field => $value) {
            if (empty($value)) {
                $this->isValid = false;
                $this->messageController->set( "This field cannot be empty.", $field);
            }
        }
    }



    public function string($field, $value, $max = INF): void
    {
        $value = trim($value);

        if (strlen($value) >= $max) {
            $this->isValid = false;
            $this->messageController->set("This field must be less than {$max} characters.", $field);
        }
    }



    public function sanitizeData(): void
    {
        $this->title = htmlspecialchars($this->title, ENT_QUOTES, 'UTF-8');
        $this->body = htmlspecialchars($this->body, ENT_QUOTES, 'UTF-8');
    }


    public function email($field , $value): void
    {
        if (! filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->isValid = false;
            $this->messageController->set("Invalid email address.", $field);
        }
    }
}