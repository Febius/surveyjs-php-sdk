<?php


namespace SurveyJsPhpSdk\Parser;


use SurveyJsPhpSdk\Model\SurveyElementModel;

class SurveyElementParser
{
    /**
     * @param array $elements
     *
     * @return SurveyElementModel[]
     */
    public static function parseToModel(array $elements): array
    {

        $elementsModels = [];

        foreach($elements as $element){

            $elementModel = new SurveyElementModel();

            switch($element->type){
                case 'rating':
                    $elementModel = self::parseRatingElement($element);
                    break;

                case 'radiogroup':
                    $elementModel = self::parseRadiogroupElement($element);
                    break;

                case 'checkbox':
                    $elementModel = self::parseCheckboxElement($element);
                    break;
            }

            $elementModel->setType($element->type);

            if(isset($element->name)){
                $elementModel->setName($element->name);
            }

            if(isset($element->title)){
                $elementModel->setTitle($element->title);
            }

            if(isset($element->isRequired)){
                $elementModel->setIsRequired($element->isRequired);
            }

            if(isset($element->choicesOrder)){
                $elementModel->setChoicesOrder($element->choicesOrder);
            }

            if(isset($element->enableIf)){
                $elementModel->setEnableIf($element->enableIf);
            }

            $elementsModels[] = $elementModel;
        }

        return $elementsModels;
    }

    private static function parseRatingElement(\stdClass $element): SurveyElementModel
    {
        $rating = new SurveyElementModel();

        $choicesData = [];

        if ( ! isset($element->rateValues)) {
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

        return $rating->setChoices(SurveyChoiceParser::parseToModel($choicesData));
    }

    private static function parseRadiogroupElement(\stdClass $element): SurveyElementModel
    {
        $radiogroup = new SurveyElementModel();

        $choicesData = [];

        foreach ($element->choices as $value) {
            $choicesData[] = ! is_object($value) ? (object)['text' => $value, 'value' => $value] : $value;
        }

        return $radiogroup->setChoices(SurveyChoiceParser::parseToModel($choicesData));
    }

    private static function parseCheckboxElement(\stdClass $element): SurveyElementModel
    {
        $checkbox = new SurveyElementModel();

        $choicesData = [];

        foreach ($element->choices as $value) {
            $choicesData[] = ! is_object($value) ? (object)['text' => $value, 'value' => $value] : $value;
        }

        return $checkbox->setChoices(SurveyChoiceParser::parseToModel($choicesData));
    }
}