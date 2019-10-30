<?php

namespace SurveyJsPhpSdk\Parser\Element;

use SurveyJsPhpSdk\Factory\ChoiceFactory;
use SurveyJsPhpSdk\Model\Element\ChoiceElementAbstract;
use SurveyJsPhpSdk\Model\Element\ElementInterface;
use SurveyJsPhpSdk\Parser\SurveyChoiceParser;

abstract class ChoiceSurveyElementParserAbstract extends DefaultSurveyElementParserAbstract
{
    /**
     * @param \stdClass $data
     * @return ElementInterface
     */
    public function parse( \stdClass $data): ElementInterface
    {
        $this->configure($data);

        if (isset($data->choicesOrder)) {
            $this->element->setChoicesOrder($data->choicesOrder);
        }

        $choiceParser = new SurveyChoiceParser();

        foreach ($this->getChoicesData($data) as $value) {
            $choiceData = $this->formatChoiceObject($value);

            $this->element->addChoice($choiceParser->parse($choiceData));
        }

        return $this->element;
    }

    /**
     * @param \stdClass $data
     *
     * @return array
     */
    protected function getChoicesData(\stdClass $data): array
    {
        return $data->choices;
    }

    /**
     * @param $value
     *
     * @return \stdClass
     */
    protected function formatChoiceObject($value): \stdClass
    {
        return ! is_object($value) ? (object)['text' => $value, 'value' => $value] : $value;
    }
}
