<?php

namespace Core;

use App\Forms\LoginForm;
use Throwable;


class ValidationException extends \Exception
{

    public readonly array $errors;
    public readonly array $old;


    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }


    public static function throw(array $errors, array $old): ValidationException
    {
        $instance = new static;

        $instance->errors = $errors;
        $instance->old = $old;

        throw $instance;
    }
}