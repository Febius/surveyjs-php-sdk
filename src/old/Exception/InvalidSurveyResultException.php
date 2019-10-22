<?php


namespace SurveyJsPhpSdk\Exception;


class InvalidSurveyResultException extends \Exception
{
    protected $message = 'At least one of the given survey results is incorrect or invalid';
}