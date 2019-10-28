<?php


namespace SurveyJsPhpSdk\Parser\Element;

use SurveyJsPhpSdk\Exception\InvalidModelGivenToParserException;
use SurveyJsPhpSdk\Model\Element\CheckboxElement;
use SurveyJsPhpSdk\Model\Element\ElementInterface;

class CheckboxElementParser extends ChoiceSurveyElementParserAbstract
{
    public function parse(ElementInterface $element, \stdClass $data): ElementInterface
    {
        if (!$element instanceof CheckboxElement) {
            throw new InvalidModelGivenToParserException(get_class($element) . ' expected: ' . CheckboxElement::class);
        }

        return parent::parse($element, $data);
    }
}
