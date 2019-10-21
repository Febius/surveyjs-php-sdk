<?php


namespace SurveyJsPhpSdk\Tests\Fake;


use SurveyJsPhpSdk\Model\Element\CustomElementModelInterface;
use SurveyJsPhpSdk\Parser\Element\CustomElementParserInterface;

class FakeCustomElementParserWrong implements CustomElementParserInterface
{

    public static function parseToModel(\stdClass $element): CustomElementModelInterface
    {
        return new FakeCustomElementModelWrong();
    }
}