<?php


namespace SurveyJsPhpSdk\Parser\Element;


use SurveyJsPhpSdk\Model\Element\ElementInterface;

interface ElementParserInterface
{
    public function configure(ElementInterface $element, \stdClass $data): ElementInterface;

    public function parse(ElementInterface $element, \stdClass $data): ElementInterface;
}