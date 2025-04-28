<?php
/**
 * Created by PhpStorm.
 * User: mohammadAmin
 * Date: 2/27/2025
 * @author: Mohammadamin Meghdadi
 * @email: mohamadamin.meghdadi@gmail.com
 * @website: https://amin-developer.ir
 * @link: https://github.com/amin-developer2005
 */


namespace App\System\Traits;

use App\Controllers\MessageController;


trait Validator
{
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
                $this->messageController->set( "This field cannot be empty.", $field);
            }
        }
    }



    public function string($field, $value, $max = INF): void
    {
        $value = trim($value);

        if (strlen($value) >= $max) {
            $this->messageController->set("This field must be less than {$max} characters.", $field);
        }
    }



    public function email($field , $value): void
    {
        if (! filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->messageController->set("Invalid email address.", $field);
        }
    }
}