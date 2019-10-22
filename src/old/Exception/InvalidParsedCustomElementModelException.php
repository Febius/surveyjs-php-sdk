<?php


namespace SurveyJsPhpSdk\Exception;


class InvalidParsedCustomElementModelException extends \Exception
{
    protected $message = 'Parsed custom element model does not correspond to configuration';
}