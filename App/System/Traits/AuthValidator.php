<?php

namespace App\System\Traits;

use App\Controllers\MessageController;
use Core\ValidationException;


trait AuthValidator
{

    public MessageController $messageController {
        set => $this->messageController = $value;
        get => $this->messageController;
    }


    /**
     * @throws ValidationException
     */
    public function validate(): void
    {
        $this->messageController = new MessageController();


        $this->validateDataNotVacant();
        $this->validateInputs();
        $this->validateEmail($this->email);
        $this->validateMobile($this->mobile);
        $this->validatePassword($this->password, $this->confirmPassword);

        if ($this->failed()) {
            $this->throwException();
        }

    }



    public function failed(): bool
    {
        if (null !== $this->messageController->getMessages() && count($this->messageController->getMessages()) > 0) {
            return true;
        }
        return false;
    }



    /**
     * @throws ValidationException
     */
    public function throwException(): void
    {
        ValidationException::throw($this->messageController->getMessages(), $this->fields);
    }





    public function validateDataNotVacant(): void
    {
        foreach ($this->fields as $key => $val) {
            if(empty(trim($val))) {
                $this->messageController->set( "The data should not be vacant.");
            }
        }

    }



    public function validateInputs(): void
    {
        foreach ($this->fields as $key => $val) {
            $sanitizedVal = filter_var($val, FILTER_SANITIZE_SPECIAL_CHARS);

            if ($sanitizedVal !== $val) {
                $this->messageController->set("The field {$key} contains potentially malicious values. Please try again!");
            }

        }
    }



    public function validateEmail(string $email): void
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->messageController->set( "$this->email + $this->password");
        }
    }



    private function validateMobile($mobile): void
    {
        $validMobileRegex = '/^\+?[0-9]{10,15}$/';

        if(! preg_match($validMobileRegex, $mobile) || strlen($mobile) < 10) {
            $this->messageController->set( "Your mobile number must be between 10 to 15 digits long and in a valid format.");
        }
    }




    private function validatePassword($password, $confirmPassword): void
    {
        if(strlen($password) < 8 || strlen($confirmPassword) < 8) {
            $this->messageController->set("Your passwords must be at least 8 characters long.");
        }


        $validPasswordRegex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';

        if(!preg_match($validPasswordRegex, $password)) {
            $this->messageController->set("Your password must contain at least one uppercase letter, one lowercase letter, one digit, and one special character.");
        }

        if($password != $confirmPassword) {
            $this->messageController->set("The passwords do not match");
        }
    }



    public function error($field, $message): static
    {
        $this->messageController->set($field, $message);
        return $this;
    }

}