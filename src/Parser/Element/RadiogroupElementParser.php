<?php


namespace SurveyJsPhpSdk\Parser\Element;

use SurveyJsPhpSdk\Exception\InvalidModelGivenToParserException;
use SurveyJsPhpSdk\Model\Element\ElementInterface;
use SurveyJsPhpSdk\Model\Element\RadioGroupElement;

class RadiogroupElementParser extends ChoiceSurveyElementParserAbstract
{
    public function parse(ElementInterface $element, \stdClass $data): ElementInterface
    {
        if (!$element instanceof RadioGroupElement) {
            throw new InvalidModelGivenToParserException(get_class($element) . ' expected: ' . RadioGroupElement::class);
        }

        return parent::parse($element, $data);
    }
}
