<?php


namespace SurveyJsPhpSdk\Model;


class SurveyElementModel
{
    /** @var string */
    private $type;

    /** @var string */
    private $name;

    /** @var string */
    private $title;

    /** @var boolean */
    private $isRequired;

    /** @var string */
    private $choicesOrder;

    /** @var string */
    private $enableIf;

    /** @var SurveyChoiceModel[]|null */
    private $choices;

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param $type
     *
     * @return SurveyElementModel
     */
    public function setType($type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param $name
     *
     * @return SurveyElementModel
     */
    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param $title
     *
     * @return SurveyElementModel
     */
    public function setTitle($title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return bool
     */
    public function isRequired(): bool
    {
        return $this->isRequired;
    }

    /**
     * @param $isRequired
     *
     * @return SurveyElementModel
     */
    public function setIsRequired($isRequired): self
    {
        $this->isRequired = $isRequired;

        return $this;
    }

    /**
     * @return string
     */
    public function getChoicesOrder(): string
    {
        return $this->choicesOrder;
    }

    /**
     * @param $choicesOrder
     *
     * @return SurveyElementModel
     */
    public function setChoicesOrder($choicesOrder): self
    {
        $this->choicesOrder = $choicesOrder;

        return $this;
    }

    /**
     * @return string
     */
    public function getEnableIf(): string
    {
        return $this->enableIf;
    }

    /**
     * @param $enableIf
     *
     * @return SurveyElementModel
     */
    public function setEnableIf($enableIf): self
    {
        $this->enableIf = $enableIf;

        return $this;
    }

    /**
     * @return SurveyChoiceModel[]|null
     */
    public function getChoices(): ?array
    {
        return $this->choices;
    }

    /**
     * @param SurveyChoiceModel[]|null $choices
     *
     * @return SurveyElementModel
     */
    public function setChoices($choices): self
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
        if($this->getName() === $result->getQuestion()){

            if($this->getType() === 'text'){
                return true;
            }

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