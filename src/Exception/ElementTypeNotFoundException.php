<?php


namespace SurveyJsPhpSdk\Exception;

class ElementTypeNotFoundException extends \Exception
{
    protected $message = 'The element type is missing from json body';
}
