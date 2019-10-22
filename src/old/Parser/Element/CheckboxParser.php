<?php


namespace SurveyJsPhpSdk\Parser\Element;

use SurveyJsPhpSdk\Model\Element\CheckboxElement;
use SurveyJsPhpSdk\Parser\SurveyChoiceParser;

class CheckboxParser
{
    /**
     * @param \stdClass $element
     *
     * @return CheckboxElement
     */
    public function parseToModel(\stdClass $element): CheckboxElement
    {
        $checkboxModel = new CheckboxElement();

        foreach ($element->choices as $value) {
            $choiceData = ! is_object($value) ? (object)['text' => $value, 'value' => $value] : $value;

            $checkboxModel->addChoice(SurveyChoiceParser::parseToModel($choiceData));
        }

        return $checkboxModel;
    }
}
