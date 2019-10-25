<?php

namespace SurveyJsPhpSdk\Parser\Element;

use SurveyJsPhpSdk\Factory\ChoiceFactory;
use SurveyJsPhpSdk\Model\Element\ChoiceElementAbstract;
use SurveyJsPhpSdk\Model\Element\ElementInterface;

abstract class ChoiceSurveyElementParserAbstract extends DefaultSurveyElementParserAbstract
{
    /**
     * @param ChoiceElementAbstract|ElementInterface $element
     * @param \stdClass $data
     * @return ElementInterface
     */
    public function parse(ElementInterface $element, \stdClass $data): ElementInterface
    {
        $this->configure($element, $data);

        if (isset($data->choicesOrder)) {
            $element->setChoicesOrder($data->choicesOrder);
        }

        foreach ($this->getChoicesData($data) as $value) {
            $choiceData = $this->formatChoiceObject($value);

            $element->addChoice(ChoiceFactory::create($choiceData));
        }

        return $element;
    }

    protected function getChoicesData(\stdClass $data){
        return $data->choices;
    }

    protected function formatChoiceObject($value){
        return ! is_object($value) ? (object)['text' => $value, 'value' => $value] : $value;
    }
}
