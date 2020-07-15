<?php

namespace SurveyJsPhpSdk\Parser\Element;

use SurveyJsPhpSdk\Parser\TextParser;

abstract class DefaultElementParserAbstract extends ElementParserAbstract
{

    protected function configure(\stdClass $data): void
    {
        parent::configure($data);

        if (isset($data->title)) {
            $textParser = new TextParser();
            $this->element->setTitle($textParser->parse($data->title));
        }

        if (isset($data->isRequired)) {
            $this->element->setRequired($data->isRequired);
        }

        if (isset($data->enableIf)) {
            $this->element->setEnableIf($data->enableIf);
        }
    }
}
