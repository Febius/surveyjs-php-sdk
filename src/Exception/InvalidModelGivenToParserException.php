<?php


namespace SurveyJsPhpSdk\Exception;

class InvalidModelGivenToParserException extends \Exception
{
    protected $message = 'Model passed to parser is invalid: ';

    public function __construct($message = "", $code = 0, \Throwable $previous = null)
    {
        $message = $this->message . $message;
        parent::__construct($message, $code, $previous);
    }
}
