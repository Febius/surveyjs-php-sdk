<?php

namespace SurveyJsPhpSdk\Model\Element;

use SurveyJsPhpSdk\Model\ChoiceModel;
use SurveyJsPhpSdk\Model\ResultModel;

abstract class ChoiceElementAbstract extends ElementAbstract
{
    /**
     * @var string
     */
    private $choicesOrder;

    /**
     * @var ChoiceModel[]
     */
    private $choices = [];

    /**
     * @var bool
     */
    private $hasOther = false;

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
     * @return ChoiceModel[]
     */
    public function getChoices(): array
    {
        return $this->choices;
    }

    public function addChoice(ChoiceModel $choiceToAdd): self
    {
        foreach ($this->choices as $choice) {
            if ($choice->getValue() === $choiceToAdd->getValue()) {
                return $this;
            }
        }

        $this->choices[] = $choiceToAdd;

        return $this;
    }

    public function removeChoice(ChoiceModel $choiceToRemove): self
    {
        foreach ($this->choices as $index => $choice) {
            if ($choice->getValue() === $choiceToRemove->getValue()) {
                unset($this->choices[$index]);
                return $this;
            }
        }

        return $this;
    }

    public function setHasOther(bool $hasOther): self
    {
        $this->hasOther = $hasOther;

        return $this;
    }

    public function hasOther(): bool
    {
        return $this->hasOther;
    }

    public function isValidResult(ResultModel $result): bool
    {
        if (!parent::isValidResult($result)) {
            if($this->isOtherResponse($result)){
                return true;
            }

            return false;
        }

        foreach ($this->getChoices() as $choice) {
            if ($choice->getValue() === $result->getAnswer()) {
                return true;
            }
        }

        return false;
    }

    protected function isOtherResponse(ResultModel $result): bool
    {
        return $this->hasOther() && $result->getQuestion() === $this->getName() . '-Comment';
    }
}
