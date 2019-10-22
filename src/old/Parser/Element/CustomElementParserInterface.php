<?php


namespace SurveyJsPhpSdk\Parser\Element;


use SurveyJsPhpSdk\Model\Element\CustomElementModelInterface;

interface CustomElementParserInterface
{
    public static function parseToModel(\stdClass $element): CustomElementModelInterface;
}