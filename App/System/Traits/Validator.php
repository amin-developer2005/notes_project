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






    public function validateNotVacant(array $data): void
    {
        foreach ($data as $field => $value) {
            if (empty(trim($value))) {
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



    public function email($field , $value): void
    {
        if (! filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->isValid = false;
            $this->messageController->set("Invalid email address.", $field);
        }
    }
}