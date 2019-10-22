<?php


namespace SurveyJsPhpSdk\Exception;


use Throwable;

class UnknownElementTypeException extends \Exception
{
    protected $message = 'Could not instantiate element of unknown type: ';

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = $this->message . $message;
        parent::__construct($message, $code, $previous);
    }
}