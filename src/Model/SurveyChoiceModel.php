<?php


namespace SurveyJsPhpSdk\Model;


class SurveyChoiceModel
{
    /** @var string */
    private $value;

    /** @var string */
    private $text;

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param $value
     *
     * @return SurveyChoiceModel
     */
    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param $text
     *
     * @return SurveyChoiceModel
     */
    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }
}