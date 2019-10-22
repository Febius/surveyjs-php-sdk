<?php

namespace SurveyJsPhpSdk\Parser\Element;

class RatingElementParser extends ChoiceElementParserAbstract
{
    public function getChoicesData(\stdClass $data): array
    {
        $choicesData = [];

        if (!isset($data->rateValues)) {
            $max = 5;

            if (isset($data->rateMax)) {
                $max = (int)$data->rateMax;
            }

            for ($i = 1; $i <= $max; $i++) {
                $choicesData[] = (object)[
                    'text'  => $i,
                    'value' => $i
                ];
            }
        } else {
            // TODO Try to define a shared way with ChoiceElementParserAbstract::parse
            foreach ($data->rateValues as $value) {
                $choicesData[] = ! is_object($value) ? (object)['text' => $value, 'value' => $value] : $value;
            }
        }

        return $choicesData;
    }
}
