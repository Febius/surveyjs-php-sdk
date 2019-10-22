<?php


namespace SurveyJsPhpSdk\Exception;


class PagePropertyNotFoundException extends \Exception
{
    protected $message = 'Could not find "pages" property in survey template json';
}