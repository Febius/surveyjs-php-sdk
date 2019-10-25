<?php


namespace SurveyJsPhpSdk\Parser\Element;


use SurveyJsPhpSdk\Model\Element\ElementInterface;

interface ElementParserInterface
{
    public function parse(ElementInterface $element, \stdClass $data): ElementInterface;
}