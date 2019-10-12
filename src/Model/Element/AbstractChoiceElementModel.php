<?php


namespace SurveyJsPhpSdk\Model\Element;


use SurveyJsPhpSdk\Model\SurveyChoiceModel;
use SurveyJsPhpSdk\Model\SurveyResultModel;

abstract class AbstractChoiceElementModel extends AbstractSurveyElementModel
{

    /**
     * @var string 
     */
    private $choicesOrder;

    /**
     * @var SurveyChoiceModel[] 
     */
    private $choices = [];

    /**
     * @return string
     */
    public function getChoicesOrder(): string
    {
        return $this->choicesOrder;
    }

    /**
     * @param string $choicesOrder
     *
     * @return AbstractChoiceElementModel
     */
    public function setChoicesOrder(string $choicesOrder): self
    {
        $this->choicesOrder = $choicesOrder;

        return $this;
    }

    /**
     * @return SurveyChoiceModel[]
     */
    public function getChoices(): array
    {
        return $this->choices;
    }

    /**
     * @param SurveyChoiceModel $choiceToAdd
     *
     * @return AbstractChoiceElementModel
     */
    public function addChoice(SurveyChoiceModel $choiceToAdd): self
    {
        foreach($this->choices as $choice){
            if($choice->getValue() === $choiceToAdd->getValue()) {
                return $this;
            }
        }

        $this->choices[] = $choiceToAdd;

        return $this;
    }

    /**
     * @param SurveyChoiceModel $choiceToRemove
     *
     * @return AbstractChoiceElementModel
     */
    public function removeChoice(SurveyChoiceModel $choiceToRemove): self
    {
        foreach($this->choices as $index => $choice){
            if($choice->getValue() === $choiceToRemove->getValue()) {
                unset($this->choices[$index]);
                return $this;
            }
        }

        return $this;
    }

    /**
     * @param SurveyResultModel $result
     *
     * @return bool
     */
    public function isValidResult(SurveyResultModel $result): bool
    {
        if(parent::isValidResult($result)) {

            /**
             * @var SurveyChoiceModel $choice
             */
            foreach($this->getChoices() as $choice){
                if($choice->getValue() === $result->getAnswer()) {
                    return true;
                }
            }
        }

        return false;
    }
}