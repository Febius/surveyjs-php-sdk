<?php


namespace SurveyJsPhpSdk\Tests\Fake;


use SurveyJsPhpSdk\Parser\Element\ElementParserAbstract;

class FakeCustomElementParser extends ElementParserAbstract
{
    protected function setupElement(): void
    {
        $this->element = new FakeCustomElementModel();
    }
}