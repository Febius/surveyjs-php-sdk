<?php


namespace SurveyJsPhpSdk\Parser\Element;

use SurveyJsPhpSdk\Model\Element\RadiogroupElement;
use SurveyJsPhpSdk\Parser\SurveyChoiceParser;

class RadiogroupParser
{
    /**
     * @param \stdClass $element
     *
     * @return RadiogroupElement
     */
    public static function parseToModel(\stdClass $element): RadiogroupElement
    {
        $radiogroupModel = new RadiogroupElement();

        foreach ($element->choices as $value) {
            $choiceData = ! is_object($value) ? (object)['text' => $value, 'value' => $value] : $value;

            $radiogroupModel->addChoice(SurveyChoiceParser::parseToModel($choiceData));
        }

        return $radiogroupModel;
    }
}