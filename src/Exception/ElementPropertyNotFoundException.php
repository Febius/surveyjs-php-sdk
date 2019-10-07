<?php


namespace SurveyJsPhpSdk\Exception;


class ElementPropertyNotFoundException extends \Exception
{
    protected $message = 'Could not find "elements" property in "pages" json section of survey template';
}