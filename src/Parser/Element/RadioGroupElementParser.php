<?php


namespace SurveyJsPhpSdk\Parser\Element;

use SurveyJsPhpSdk\Model\Element\RadioGroupElement;

class RadioGroupElementParser extends ChoiceElementParserAbstract
{
    protected function setupElement(): void
    {
        $this->element = new RadioGroupElement();
    }
}
