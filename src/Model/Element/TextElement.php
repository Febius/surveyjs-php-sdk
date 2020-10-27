<?php

namespace SurveyJsPhpSdk\Model\Element;

use SurveyJsPhpSdk\Model\TextModel;

class TextElement extends ElementAbstract
{
    /**
     * @var string
     */
    private $inputType;

    /**
     * @var TextModel
     */
    private $placeholder;

    /**
     * @var string
     */
    private $min;

    /**
     * @var string
     */
    private $max;

    /**
     * @var integer
     */
    private $step;

    public function setInputType(string $type): TextElement
    {
        $this->inputType = $type;

        return $this;
    }

    public function getInputType(): string
    {
        return $this->inputType;
    }

    public function setPlaceholder(TextModel $placeholder): TextElement
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    public function getPlaceholder(): TextModel
    {
        return $this->placeholder;
    }

    public function setMin(string $min): TextElement
    {
        $this->min = $min;

        return $this;
    }

    public function getMin(): string
    {
        return $this->min;
    }

    public function setMax(string $max): TextElement
    {
        $this->max = $max;

        return $this;
    }

    public function getMax(): string
    {
        return $this->max;
    }

    public function setStep(string $step): TextElement
    {
        $this->step = $step;

        return $this;
    }

    public function getStep(): string
    {
        return $this->step;
    }
}
