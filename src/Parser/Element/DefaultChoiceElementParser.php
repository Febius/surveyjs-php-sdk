<?php

namespace SurveyJsPhpSdk\Parser\Element;

class DefaultChoiceElementParser extends ChoiceElementParserAbstract
{
    protected function getChoicesData(\stdClass $data): array
    {
        return $data->choices;
    }
}
