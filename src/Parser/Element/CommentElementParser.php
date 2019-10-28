<?php


namespace SurveyJsPhpSdk\Parser\Element;

use SurveyJsPhpSdk\Exception\InvalidModelGivenToParserException;
use SurveyJsPhpSdk\Model\Element\CommentElement;
use SurveyJsPhpSdk\Model\Element\ElementInterface;

class CommentElementParser extends DefaultSurveyElementParserAbstract
{
    public function parse(ElementInterface $element, \stdClass $data): ElementInterface
    {
        if (! $element instanceof CommentElement) {
            throw new InvalidModelGivenToParserException(get_class($element) . ' expected: ' . CommentElement::class);
        }

        return parent::parse($element, $data);
    }
}
