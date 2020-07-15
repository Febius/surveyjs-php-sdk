<?php


namespace SurveyJsPhpSdk\Parser;

use SurveyJsPhpSdk\Model\ChoiceModel;

class ChoiceParser
{

    public function parse(\stdClass $data): ChoiceModel
    {
        $choiceModel = new ChoiceModel();
        $textParser = new TextParser();

        $choiceModel->setText($textParser->parse($data->text));
        $choiceModel->setValue($data->value);

        return $choiceModel;
    }
}
