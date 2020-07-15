<?php

namespace SurveyJsPhpSdk\Model\Element;

use SurveyJsPhpSdk\Model\ResultModel;
use SurveyJsPhpSdk\Model\TextModel;

abstract class ElementAbstract implements ElementInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var TextModel
     */
    private $title;

    /**
     * @var boolean
     */
    private $required;

    /**
     * @var string
     */
    private $enableIf;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): ElementInterface
    {
        $this->name = $name;

        return $this;
    }

    public function getTitle(): TextModel
    {
        return $this->title;
    }

    public function setTitle(TextModel $title): ElementInterface
    {
        $this->title = $title;

        return $this;
    }

    public function isRequired(): bool
    {
        return $this->required;
    }

    public function setRequired(bool $required): ElementInterface
    {
        $this->required = $required;

        return $this;
    }

    public function getEnableIf(): string
    {
        return $this->enableIf;
    }

    public function setEnableIf(string $enableIf): ElementInterface
    {
        $this->enableIf = $enableIf;

        return $this;
    }

    public function isValidResult(ResultModel $result): bool
    {
        return $this->getName() === $result->getQuestion();
    }
}
