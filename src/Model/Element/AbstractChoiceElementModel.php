<?php


namespace SurveyJsPhpSdk\Model\Element;


use SurveyJsPhpSdk\Model\SurveyChoiceModel;
use SurveyJsPhpSdk\Model\SurveyResultModel;

abstract class AbstractChoiceElementModel extends AbstractSurveyElementModel
{

    /** @var string */
    private $choicesOrder;

    /** @var SurveyChoiceModel[] */
    private $choices;

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
     * @param array SurveyChoiceModel[] $choices
     *
     * @return AbstractChoiceElementModel
     */
    public function setChoices(array $choices): self
    {
        $this->choices = $choices;

        return $this;
    }

    /**
     * @param SurveyResultModel $result
     *
     * @return bool
     */
    public function isValidResult(SurveyResultModel $result): bool
    {
        if(parent::isValidResult($result)){

            /** @var SurveyChoiceModel $choice */
            foreach($this->getChoices() as $choice){
                if($choice->getValue() === $result->getAnswer()){
                    return true;
                }
            }
        }

        return false;
    }
}