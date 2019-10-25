<?php

namespace SurveyJsPhpSdk\Parser\Element;

use SurveyJsPhpSdk\Model\Element\ElementAbstract;
use SurveyJsPhpSdk\Model\Element\ElementInterface;

abstract class DefaultSurveyElementParserAbstract extends ElementParserAbstract
{

    protected function configure(ElementInterface $element, \stdClass $data): ElementInterface
    {
        /** @var ElementAbstract $element */
        $element = parent::configure($element, $data);

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
}
