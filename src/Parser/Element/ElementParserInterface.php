<?php


namespace SurveyJsPhpSdk\Parser\Element;

use SurveyJsPhpSdk\Model\Element\ElementInterface;

interface ElementParserInterface
{
    public function parse(\stdClass $data): ElementInterface;
}
