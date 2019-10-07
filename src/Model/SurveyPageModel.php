<?php


namespace SurveyJsPhpSdk\Model;


class SurveyPageModel
{
    /** @var string */
    private $name;

    /** @var SurveyElementModel[] */
    private $elements;

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
     * @return SurveyPageModel
     */
    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return SurveyElementModel[]
     */
    public function getElements(): array
    {
        return $this->elements;
    }

    /**
     * @param $elements
     *
     * @return SurveyPageModel
     */
    public function setElements($elements): self
    {
        $this->elements = $elements;

        return $this;
    }
}