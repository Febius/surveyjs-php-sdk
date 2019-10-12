<?php


namespace SurveyJsPhpSdk\Parser\Element;

use SurveyJsPhpSdk\Model\Element\RatingElement;
use SurveyJsPhpSdk\Parser\SurveyChoiceParser;

class RatingParser
{
    /**
     * @param \stdClass $element
     *
     * @return RatingElement
     */
    public static function parseToModel(\stdClass $element): RatingElement
    {
        $ratingModel = new RatingElement();

        $choicesData = [];

        if (! isset($element->rateValues)) {
            $max = 5;

            if (isset($element->rateMax)) {
                $max = (int)$element->rateMax;
            }


            for ($i = 1; $i <= $max; $i++) {
                $choicesData[] = (object)[
                    'text'  => $i,
                    'value' => $i
                ];
            }
        } else {
            foreach ($element->rateValues as $value) {
                $choicesData[] = ! is_object($value) ? (object)['text' => $value, 'value' => $value] : $value;
            }
        }

        foreach($choicesData as $choice){
            $ratingModel->addChoice(SurveyChoiceParser::parseToModel($choice));
        }

        return $ratingModel;
    }
}