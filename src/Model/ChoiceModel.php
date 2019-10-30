<?php

namespace SurveyJsPhpSdk\Model;

class ChoiceModel
{
    /**
     * @var string
     */
    private $value;

    /**
     * @var string
     */
    private $text;

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }
}
