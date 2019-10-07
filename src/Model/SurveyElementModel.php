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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return bool
     */
    public function isRequired()
    {
        return $this->isRequired;
    }

    /**
     * @param bool $isRequired
     */
    public function setIsRequired($isRequired)
    {
        $this->isRequired = $isRequired;
    }

    /**
     * @return string
     */
    public function getChoicesOrder()
    {
        return $this->choicesOrder;
    }

    /**
     * @param string $choicesOrder
     */
    public function setChoicesOrder($choicesOrder)
    {
        $this->choicesOrder = $choicesOrder;
    }

    /**
     * @return string
     */
    public function getEnableIf()
    {
        return $this->enableIf;
    }

    /**
     * @param string $enableIf
     */
    public function setEnableIf($enableIf)
    {
        $this->enableIf = $enableIf;
    }

    /**
     * @return SurveyChoiceModel[]|null
     */
    public function getChoices()
    {
        return $this->choices;
    }

    /**
     * @param SurveyChoiceModel[]|null $choices
     */
    public function setChoices($choices)
    {
        $this->choices = $choices;
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