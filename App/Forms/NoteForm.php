<?php
/**
 * Created by PhpStorm.
 * User: mohammadAmin
 * Date: 3/5/2025
 * @author: Mohammadamin Meghdadi
 * @email: mohamadamin.meghdadi@gmail.com
 * @website: https://amin-developer.ir
 * @link: https://github.com/amin-developer2005
 */


namespace App\Forms;

use App\Controllers\MessageController;
use App\System\Traits\Validator;
use Core\ValidationException;


class NoteForm
{
    use Validator;


    public function __construct(public array $data)
    {
        $this->messageController = new MessageController();

        $this->validateNotVacant($this->data);
        $this->string('title' , $this->data['title'], 100);
        $this->string('body' , $this->data['body'],  1000);
    }


    /**
     * @throws ValidationException
     */
    public static function validate(array $data): static
    {
        $instance = new static($data);

        if ($instance->failed()) {
            ValidationException::throw($instance->errors(), $instance->data);
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


    public function errors(): ?array
    {
        return $this->messageController->getMessages();
    }
}