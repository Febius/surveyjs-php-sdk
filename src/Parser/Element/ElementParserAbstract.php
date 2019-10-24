<?php

namespace SurveyJsPhpSdk\Parser\Element;

use SurveyJsPhpSdk\Model\Element\ElementInterface;

abstract class ElementParserAbstract implements ElementParserInterface
{

    public function configure(ElementInterface $element, \stdClass $data): ElementInterface
    {
        if (isset($data->name)) {
            $element->setName($data->name);
        }

        return $element;
    }

    public function parse(ElementInterface $element, \stdClass $data): ElementInterface
    {
        return $this->configure($element, $data);
    }
}
