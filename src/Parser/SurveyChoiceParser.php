<?php


namespace SurveyJsPhpSdk\Parser;


use SurveyJsPhpSdk\Model\SurveyChoiceModel;

class SurveyChoiceParser
{

    /**
     * @param \stdClass $choice
     *
     * @return SurveyChoiceModel
     */
    public static function parseToModel(\stdClass $choice): SurveyChoiceModel
    {
        $choiceModel = new SurveyChoiceModel();

        $choiceModel->setText($choice->text);
        $choiceModel->setValue($choice->value);

        return $choiceModel;
    }
}