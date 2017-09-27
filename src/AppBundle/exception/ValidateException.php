<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 27.09.2017
 * Time: 19:00
 */

namespace AppBundle\exception;


use Symfony\Component\Validator\ConstraintViolationListInterface;
use Throwable;

class ValidateException extends \Exception
{
    public function __construct(ConstraintViolationListInterface $result, Throwable $previous = null)
    {
        parent::__construct('validate errors '.$result->count(), 400, $previous);
    }
}