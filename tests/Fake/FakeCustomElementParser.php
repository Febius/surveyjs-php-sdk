<?php


namespace SurveyJsPhpSdk\Tests\Fake;


use SurveyJsPhpSdk\Model\Element\ElementInterface;
use SurveyJsPhpSdk\Parser\Element\ElementParserAbstract;

class FakeCustomElementParser extends ElementParserAbstract
{

    public function parse(\stdClass $data): ElementInterface
    {
        $this->element = new FakeCustomElementModel();

        return parent::parse($data);
    }
}