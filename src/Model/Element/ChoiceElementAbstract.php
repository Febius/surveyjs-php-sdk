<?php

namespace SurveyJsPhpSdk\Model\Element;

use SurveyJsPhpSdk\Model\Element\Choice\Choice;
use SurveyJsPhpSdk\Model\ResultModel;

abstract class ChoiceElementAbstract extends ElementAbstract
{
    /**
     * @var string
     */
    private $choicesOrder;

    /**
     * @var Choice[]
     */
    private $choices = [];

    public function getChoicesOrder(): string
    {
        return $this->choicesOrder;
    }

    public function setChoicesOrder(string $choicesOrder): self
    {
        $this->choicesOrder = $choicesOrder;

        return $this;
    }

    /**
     * @return Choice[]
     */
    public function getChoices(): array
    {
        return $this->choices;
    }

    public function addChoice(Choice $choiceToAdd): self
    {
        foreach ($this->choices as $choice) {
            if ($choice->getValue() === $choiceToAdd->getValue()) {
                return $this;
            }
        }

        $this->choices[] = $choiceToAdd;

        return $this;
    }

    public function removeChoice(Choice $choiceToRemove): self
    {
        foreach ($this->choices as $index => $choice) {
            if ($choice->getValue() === $choiceToRemove->getValue()) {
                unset($this->choices[$index]);
                return $this;
            }
        }

        return $this;
    }

    public function isValidResult(ResultModel $result): bool
    {
        if (parent::isValidResult($result)) {
            foreach ($this->getChoices() as $choice) {
                if ($choice->getValue() === $result->getAnswer()) {
                    return true;
                }
            }
        }

        return false;
    }
}
