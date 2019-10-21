<?php


namespace SurveyJsPhpSdk\Model;


use SurveyJsPhpSdk\Model\Element\AbstractSurveyElementModel;
use SurveyJsPhpSdk\Model\Element\BaseSurveyElementModel;

class SurveyPageModel
{
    /**
     * @var string 
     */
    private $name;

    /**
     * @var AbstractSurveyElementModel[] 
     */
    private $elements = [];

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return SurveyPageModel
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return BaseSurveyElementModel[]
     */
    public function getElements(): array
    {
        return $this->elements;
    }

    /**
     * @param BaseSurveyElementModel $elementToAdd
     *
     * @return SurveyPageModel
     */
    public function addElement(BaseSurveyElementModel $elementToAdd): self
    {
        foreach($this->elements as $element){
            if($element->getName() === $elementToAdd->getName()) {
                return $this;
            }
        }

        $this->elements[] = $elementToAdd;

        return $this;
    }

    /**
     * @param BaseSurveyElementModel $elementToRemove
     *
     * @return SurveyPageModel
     */
    public function removeElement(BaseSurveyElementModel $elementToRemove): self
    {
        foreach($this->elements as $index => $element){
            if($element->getName() === $elementToRemove->getName()) {
                unset($this->elements[$index]);
                return $this;
            }
        }

        return $this;
    }
}