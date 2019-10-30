<?php

namespace SurveyJsPhpSdk\Parser\Element;

abstract class DefaultSurveyElementParserAbstract extends ElementParserAbstract
{

    protected function configure(\stdClass $data): void
    {
        parent::configure($data);

        if (isset($data->title)) {
            $this->element->setTitle($data->title);
        }

        if (isset($data->isRequired)) {
            $this->setRequired($data->isRequired);
        }

        if (isset($data->enableIf)) {
            $this->setEnableIf($data->enableIf);
        }
    }
}
