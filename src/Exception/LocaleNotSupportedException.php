<?php

namespace SurveyJsPhpSdk\Exception;

class LocaleNotSupportedException extends \Exception
{
    public function __construct($locale = "", $code = 0, \Throwable $previous = null)
    {
        $message = 'Locale "' . $locale . '" is not supported';
        parent::__construct($message, $code, $previous);
    }
}
