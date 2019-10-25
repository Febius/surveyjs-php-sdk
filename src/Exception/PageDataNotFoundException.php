<?php


namespace SurveyJsPhpSdk\Exception;

class PageDataNotFoundException extends \Exception
{
    protected $message = 'missing page data from json';
}
