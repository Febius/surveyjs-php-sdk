<?php


namespace SurveyJsPhpSdk\Exception;

class InvalidSurveyResultException extends \Exception
{
    protected $message = 'One of the survey results given is invalid: ';

    public function __construct($message = "", $code = 0, \Throwable $previous = null)
    {
        $message = $this->message . $message;
        parent::__construct($message, $code, $previous);
    }
}
