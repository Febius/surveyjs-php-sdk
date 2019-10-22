<?php

namespace SurveyJsPhpSdk\Factory;

use SurveyJsPhpSdk\Model\Element\Choice\Choice;

class ChoiceFactory
{
    public static function create(\stdClass $choiceData): Choice
    {
        $choiceModel = new Choice();

        $choiceModel->setText($choiceData->text);
        $choiceModel->setValue($choiceData->value);

        return $choiceModel;
    }
}
