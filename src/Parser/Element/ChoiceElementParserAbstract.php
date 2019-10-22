<?php

namespace SurveyJsPhpSdk\Parser\Element;

use SurveyJsPhpSdk\Factory\ChoiceFactory;
use SurveyJsPhpSdk\Model\Element\ChoiceElementAbstract;
use SurveyJsPhpSdk\Model\Element\ElementInterface;

abstract class ChoiceElementParserAbstract extends ElementParserAbstract
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
            // TODO Try to define a shared way with RatingElementParser::getChoicesData
            $choiceData = ! is_object($value) ? (object)['text' => $value, 'value' => $value] : $value;

            $element->addChoice(ChoiceFactory::create($choiceData));
        }

        return $element;
    }

    abstract protected function getChoicesData(\stdClass $data): array;
}
