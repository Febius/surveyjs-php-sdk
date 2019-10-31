<?php


namespace SurveyJsPhpSdk\Exception;

class ElementNameNotFoundException extends \Exception
{
    protected $message = 'The property "name" is required for all elements. This element has none: ';

    public function __construct($message = "", $code = 0, \Throwable $previous = null)
    {
        $message = $this->message . $message;
        parent::__construct($message, $code, $previous);
    }
}
