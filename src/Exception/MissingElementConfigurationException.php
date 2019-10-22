<?php

namespace SurveyJsPhpSdk\Exception;

class MissingElementConfigurationException extends \Exception
{
    protected $message = 'The ElementConfiguration is missing: ';

    public function __construct($message = "", $code = 0, \Throwable $previous = null)
    {
        $message = $this->message . $message;
        parent::__construct($message, $code, $previous);
    }
}
