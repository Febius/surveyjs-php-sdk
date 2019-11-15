<?php


namespace SurveyJsPhpSdk\Tests\Fake;


use SurveyJsPhpSdk\Configuration\ElementConfigurationInterface;
use SurveyJsPhpSdk\Model\Element\ElementInterface;
use SurveyJsPhpSdk\Parser\Element\ElementParserAbstract;

class FakeCustomElementConfiguration implements ElementConfigurationInterface
{
    public function getType(): string
    {
        return 'custom_test_element_type';
    }

    public function getElement(): ElementInterface
    {
        return new FakeCustomElementModel();
    }

    public function getParser(): ElementParserAbstract
    {
        return new FakeCustomElementParser();
    }
}