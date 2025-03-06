<?php

namespace App\Forms;

use Core\ValidationException;
use App\System\Traits\AuthValidator;
use App\Controllers\MessageController;
use App\System\Traits\Validator;



class LoginForm
{
    use Validator;



    public function __construct(public array $data)
    {
        $this->messageController = new MessageController();

        $this->string('email', $this->data['email']);
        $this->email('email', $this->data['email']);
        $this->string('password', $this->data['password']);
    }



    /**
     * @throws ValidationException
     */
    public static function validate(array $data): static
    {
        $instance = new static($data);

        if ($instance->failed()) {
            $instance->throwException();
        }

        return $instance;
    }



    public function failed(): bool
    {
        if (null !== $this->errors() && count($this->errors()) > 0) {
            return true;
        }
        return false;
    }




    /**
     * @throws ValidationException
     */
    public function throwException(): void
    {
        ValidationException::throw($this->errors(), $this->data);
    }


    public function error($field, $message): static
    {
        $this->messageController->set($message, $field);
        return $this;
    }



    public function errors(): ?array
    {
        return $this->messageController->getMessages();
    }

}