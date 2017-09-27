<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 27.09.2017
 * Time: 17:07
 */
namespace AppBundle\exception;

use Throwable;

class AddLinkException extends \Exception
{
    public function __construct($message = "", Throwable $previous = null)
    {
        parent::__construct($message, 400, $previous);
    }
}