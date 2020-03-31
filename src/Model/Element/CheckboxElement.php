<?php

namespace SurveyJsPhpSdk\Model\Element;

use SurveyJsPhpSdk\Model\ChoiceModel;
use SurveyJsPhpSdk\Model\ResultModel;

class CheckboxElement extends ChoiceElementAbstract
{
    public function isValidResult(ResultModel $result): bool
    {
        if(!is_array($result->getAnswer())){
            return false;
        }

        if ($this->getName() !== $result->getQuestion()) {
            return false;
        }

        foreach ($result->getAnswer() as $answer) {
            if (! in_array($answer, array_map(function (ChoiceModel $a){ return $a->getValue(); }, $this->getChoices()))) {
                return false;
            }
        }

        return true;
    }
}
