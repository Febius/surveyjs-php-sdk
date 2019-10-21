<?php


namespace SurveyJsPhpSdk\Exception;


class InvalidCustomElementParserException extends \Exception
{
    protected $message = 'The custom element parser given to configurations does not implement the correct interface';
}