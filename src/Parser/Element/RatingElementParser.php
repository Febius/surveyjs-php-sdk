<?php

namespace SurveyJsPhpSdk\Parser\Element;

use SurveyJsPhpSdk\Model\Element\ElementInterface;
use SurveyJsPhpSdk\Model\Element\RatingElement;

class RatingElementParser extends ChoiceElementParserAbstract
{
    public function parse(\stdClass $data): ElementInterface
    {
        $this->element = new RatingElement();

        return parent::parse($data);
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
