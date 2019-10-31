<?php


namespace SurveyJsPhpSdk\Parser\Element;

use SurveyJsPhpSdk\Model\Element\CheckboxElement;
use SurveyJsPhpSdk\Model\Element\ElementInterface;

class CheckboxElementParser extends ChoiceElementParserAbstract
{
    public function parse(\stdClass $data): ElementInterface
    {
        $this->element = new CheckboxElement();

        return parent::parse($data);
    }
}
