<?php

namespace SurveyJsPhpSdk\Parser\Element;

use SurveyJsPhpSdk\Model\Element\ElementInterface;
use SurveyJsPhpSdk\Parser\ChoiceParser;

abstract class ChoiceElementParserAbstract extends DefaultElementParserAbstract
{
    /**
     * @param \stdClass $data
     * @return ElementInterface
     */
    public function parse(\stdClass $data): ElementInterface
    {
        $this->setupElement();

        $this->configure($data);

        if (isset($data->choicesOrder)) {
            $this->element->setChoicesOrder($data->choicesOrder);
        }

        $choiceParser = new ChoiceParser();

        foreach ($this->getChoicesData($data) as $value) {
            $choiceData = $this->formatChoiceObject($value);

            $this->element->addChoice($choiceParser->parse($choiceData));
        }

        if (isset($data->otherText)) {
            $this->element->setHasOther(true);

            $this->element->addChoice($choiceParser->parse($this->formatChoiceObject(
                is_string($data->otherText)
                    ? 'other'
                    : (object)['text' => $data->otherText, 'value' => 'other']
            )));
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
     * @param \stdClass|string|number $value
     *
     * @return \stdClass
     */
    protected function formatChoiceObject($value): \stdClass
    {
        return !is_object($value) ? (object)['text' => strval($value), 'value' => $value] : $value;
    }
}
