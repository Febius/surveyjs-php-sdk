<?php


namespace SurveyJsPhpSdk\Parser;


use SurveyJsPhpSdk\Model\SurveyChoiceModel;

class SurveyChoiceParser
{

    /**
     * @param array $choices
     *
     * @return SurveyChoiceModel[]
     */
    public static function parseToModel(array $choices){
        $choicesModels = [];

        foreach($choices as $choice){
            $choiceModel = new SurveyChoiceModel();

            $choiceModel->setText($choice['text']);

            $choiceModel->setValue($choice['value']);

            $choicesModels[] = $choiceModel;
        }

        return $choicesModels;
    }
}