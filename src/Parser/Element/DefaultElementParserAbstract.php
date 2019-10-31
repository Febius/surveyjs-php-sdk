<?php

namespace SurveyJsPhpSdk\Parser\Element;

abstract class DefaultElementParserAbstract extends ElementParserAbstract
{

    protected function configure(\stdClass $data): void
    {
        parent::configure($data);

        if (isset($data->title)) {
            $this->element->setTitle($data->title);
        }

        if (isset($data->isRequired)) {
            $this->element->setRequired($data->isRequired);
        }

        if (isset($data->enableIf)) {
            $this->element->setEnableIf($data->enableIf);
        }
    }
}
