<?php

namespace SurveyJsPhpSdk\Exception;

class InvalidElementConfigurationException extends \Exception
{
    protected $message = 'The given object does not implement the ElementConfiguration interface';
}
