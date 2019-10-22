<?php


namespace SurveyJsPhpSdk\Exception;


class InvalidCustomElementModelException extends \Exception
{
    protected $message = 'The custom element model given to configurations does not implement the correct interface';
}