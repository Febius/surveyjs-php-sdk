<?php


namespace SurveyJsPhpSdk\Model;


use SurveyJsPhpSdk\Model\Element\AbstractSurveyElementModel;

class SurveyPageModel
{
    /** @var string */
    private $name;

    /** @var AbstractSurveyElementModel[] */
    private $elements;

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
     * @return AbstractSurveyElementModel[]
     */
    public function getElements(): array
    {
        return $this->elements;
    }

    /**
     * @param AbstractSurveyElementModel[] $elements
     *
     * @return SurveyPageModel
     */
    public function setElements(array $elements): self
    {
        $this->elements = $elements;

        return $this;
    }
}