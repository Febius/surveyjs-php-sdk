<?php

namespace SurveyJsPhpSdk\Parser\Element;

class RatingElementParser extends ChoiceSurveyElementParserAbstract
{
    protected function getChoicesData(\stdClass $data): array
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
            foreach ($data->rateValues as $value) {
                $choicesData[] = $this->formatChoiceObject($value);
            }
        }

        return $choicesData;
    }
}
