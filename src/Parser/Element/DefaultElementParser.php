<?php

namespace SurveyJsPhpSdk\Parser\Element;

use SurveyJsPhpSdk\Model\Element\ElementAbstract;
use SurveyJsPhpSdk\Model\Element\ElementInterface;

class DefaultElementParser extends ElementParserAbstract
{
    public function configure(ElementInterface $element, \stdClass $data): ElementInterface
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
