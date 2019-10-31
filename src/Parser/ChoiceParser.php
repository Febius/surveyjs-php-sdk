<?php


namespace SurveyJsPhpSdk\Parser;

use SurveyJsPhpSdk\Model\ChoiceModel;

class ChoiceParser
{

    public function parse(\stdClass $data): ChoiceModel
    {
        $choiceModel = new ChoiceModel();

        $choiceModel->setText($data->text);
        $choiceModel->setValue($data->value);

        return $choiceModel;
    }
}
