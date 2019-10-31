<?php


namespace SurveyJsPhpSdk\Parser\Element;

use SurveyJsPhpSdk\Model\Element\ElementInterface;
use SurveyJsPhpSdk\Model\Element\RadioGroupElement;

class RadioGroupElementParser extends ChoiceSurveyElementParserAbstract
{
    public function parse(\stdClass $data): ElementInterface
    {
        $this->element = new RadioGroupElement();

        return parent::parse($data);
    }
}
