<?php


namespace SurveyJsPhpSdk\Parser;


use SurveyJsPhpSdk\Exception\UnknownElementTypeException;
use SurveyJsPhpSdk\Factory\ElementModelFactory;
use SurveyJsPhpSdk\Model\Element\AbstractChoiceElementModel;
use SurveyJsPhpSdk\Model\Element\AbstractSurveyElementModel;
use SurveyJsPhpSdk\Model\Element\CheckboxElement;
use SurveyJsPhpSdk\Model\Element\CommentElement;
use SurveyJsPhpSdk\Model\Element\RadiogroupElement;
use SurveyJsPhpSdk\Model\Element\RatingElement;

class SurveyElementParser
{
    /**
     * @param array $elements
     *
     * @throws UnknownElementTypeException
     *
     * @return AbstractSurveyElementModel[]
     */
    public static function parseToModel(array $elements): array
    {

        $elementsModels = [];

        foreach($elements as $element){

            $elementModel = ElementModelFactory::getModel($element->type);
            $parser = 'parse' . (new \ReflectionClass($elementModel))->getShortName();

            $elementModel = self::$parser($elementModel, $element);

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

    /**
     * @param RatingElement $model
     * @param \stdClass $element
     *
     * @return AbstractChoiceElementModel
     */
    private static function parseRatingElement(RatingElement $model, \stdClass $element): AbstractChoiceElementModel
    {
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

        return $model->setChoices(SurveyChoiceParser::parseToModel($choicesData));
    }

    /**
     * @param RadiogroupElement $model
     * @param \stdClass $element
     *
     * @return AbstractChoiceElementModel
     */
    private static function parseRadiogroupElement(RadiogroupElement $model, \stdClass $element): AbstractChoiceElementModel
    {
        $choicesData = [];

        foreach ($element->choices as $value) {
            $choicesData[] = ! is_object($value) ? (object)['text' => $value, 'value' => $value] : $value;
        }

        return $model->setChoices(SurveyChoiceParser::parseToModel($choicesData));
    }

    /**
     * @param CheckboxElement $model
     * @param \stdClass $element
     *
     * @return CheckboxElement
     */
    private static function parseCheckboxElement(CheckboxElement $model, \stdClass $element): AbstractChoiceElementModel
    {
        $choicesData = [];

        foreach ($element->choices as $value) {
            $choicesData[] = ! is_object($value) ? (object)['text' => $value, 'value' => $value] : $value;
        }

        return $model->setChoices(SurveyChoiceParser::parseToModel($choicesData));
    }

    /**
     * @param CommentElement $model
     * @param \stdClass $element
     *
     * @return AbstractSurveyElementModel
     */
    private static function parseCommentElement(CommentElement $model, \stdClass $element): AbstractSurveyElementModel
    {
        return $model;
    }
}