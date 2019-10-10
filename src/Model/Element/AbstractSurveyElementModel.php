<?php


namespace SurveyJsPhpSdk\Model\Element;


use SurveyJsPhpSdk\Model\SurveyResultModel;

abstract class AbstractSurveyElementModel
{

    /** @var string */
    private $name;

    /** @var string */
    private $title;

    /** @var boolean */
    private $isRequired;

    /** @var string */
    private $enableIf;

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
     * @return AbstractSurveyElementModel
     */
    public function setName(string $name): self
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
     * @param string $title
     *
     * @return AbstractSurveyElementModel
     */
    public function setTitle(string $title): self
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
     * @param bool $isRequired
     *
     * @return AbstractSurveyElementModel
     */
    public function setIsRequired(bool $isRequired): self
    {
        $this->isRequired = $isRequired;

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
     * @param string $enableIf
     *
     * @return AbstractSurveyElementModel
     */
    public function setEnableIf(string $enableIf): self
    {
        $this->enableIf = $enableIf;

        return $this;
    }

    /**
     * @param SurveyResultModel $result
     *
     * @return bool
     */
    public function isValidResult(SurveyResultModel $result): bool
    {
        return $this->getName() === $result->getQuestion();
    }
}