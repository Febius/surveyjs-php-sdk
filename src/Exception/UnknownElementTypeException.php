<?php


namespace SurveyJsPhpSdk\Exception;


class UnknownElementTypeException extends \Exception
{
    protected $message = 'Could not instantiate element of unknown type';
}