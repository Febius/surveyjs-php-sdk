<?php

namespace SurveyJsPhpSdk\Parser\Element;

use SurveyJsPhpSdk\Model\Element\ElementInterface;

abstract class ElementParserAbstract
{
    protected function configure(ElementInterface $element, \stdClass $data): ElementInterface
    {
        if (isset($data->name)) {
            $element->setName($data->name);
        }

        if (isset($data->title)) {
            $element->setTitle($data->title);
        }

        if (isset($data->isRequired)) {
            $element->setRequired($data->isRequired);
        }

        if (isset($data->enableIf)) {
            $element->setEnableIf($data->enableIf);
        }

        return $element;
    }

    abstract public function parse(ElementInterface $element, \stdClass $data): ElementInterface;
}
