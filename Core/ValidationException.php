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


namespace Core;

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