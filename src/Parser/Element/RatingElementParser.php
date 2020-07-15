<?php

namespace SurveyJsPhpSdk\Parser\Element;

use SurveyJsPhpSdk\Model\Element\RatingElement;

class RatingElementParser extends ChoiceElementParserAbstract
{

    protected function setupElement(): void
    {
        $this->element = new RatingElement();
    }

    protected function getChoicesData(\stdClass $data): array
    {
        $choicesData = [];

        if (!isset($data->rateValues)) {
            $max = 5;

            if (isset($data->rateMax)) {
                $max = (int)$data->rateMax;
            }

            for ($i = 1; $i <= $max; $i++) {
                $choicesData[] = $this->formatChoiceObject($i);
            }
        } else {
            foreach ($data->rateValues as $value) {
                $choicesData[] = $this->formatChoiceObject($value);
            }
        }

        return $choicesData;
    }
}
