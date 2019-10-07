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
     * @return SurveyElementModel[]
     */
    public function getElements()
    {
        return $this->elements;
    }

    /**
     * @param SurveyElementModel[] $elements
     */
    public function setElements($elements)
    {
        $this->elements = $elements;
    }
}