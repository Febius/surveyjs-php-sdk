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

            if(isset($element->type)){
                $elementModel->setType($element->type);
            }

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

            if(isset($element->choices)){
                $elementModel->setChoices(SurveyChoiceParser::parseToModel($element->choices));
            }

            $elementsModels[] = $elementModel;
        }

        return $elementsModels;
    }
}