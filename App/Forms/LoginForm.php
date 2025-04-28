<?php
/**
 * Created by PhpStorm.
 * User: mohammadAmin
 * Date: 3/2/2025
 * @author: Mohammadamin Meghdadi
 * @email: mohamadamin.meghdadi@gmail.com
 * @website: https://amin-developer.ir
 * @link: https://github.com/amin-developer2005
 */


namespace App\Forms;

use Core\ValidationException;
use App\System\Traits\AuthValidator;
use App\Controllers\MessageController;
use App\System\Traits\Validator;



class LoginForm
{
    use Validator;

    public array $data {
        set => $this->data = $value;
        get => $this->data;
    }

    public array $errors {
        get {
           return $this->messageController->getMessages();
        }
    }


    public function __construct(array $data)
    {
        $this->data = $data;
        $this->messageController = new MessageController();

        $this->validateNotVacant($this->data);
        $this->string('email', $this->data['email']);
        $this->email('email', $this->data['email']);
        $this->string('password', $this->data['password']);
    }



    /**
     * @throws ValidationException
     */
    public static function validate(array $data): static
    {
        $login = new static($data);

        if ($login->failed()) {
            $login->throwException();
        }

        return $login;
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