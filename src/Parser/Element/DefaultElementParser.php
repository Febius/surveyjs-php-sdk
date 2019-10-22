<?php

namespace SurveyJsPhpSdk\Parser\Element;

use SurveyJsPhpSdk\Model\Element\ElementInterface;

class DefaultElementParser extends ElementParserAbstract
{
    public function parse(ElementInterface $element, \stdClass $data): ElementInterface
    {
        return $this->configure($element, $data);
    }
}
