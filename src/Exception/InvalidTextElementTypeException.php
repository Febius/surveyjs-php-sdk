<?php

namespace SurveyJsPhpSdk\Exception;

class InvalidTextElementTypeException extends \Exception
{
    public function __construct($type = "", $code = 0, \Throwable $previous = null)
    {
        $message = 'The given text element type "' . $type . '" is not supported';
        parent::__construct($message, $code, $previous);
    }
}
