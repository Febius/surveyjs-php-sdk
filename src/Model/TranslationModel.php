<?php

namespace SurveyJsPhpSdk\Model;

class TranslationModel
{
    /**
     * @var string;
     */
    private $locale;

    /**
     * @var string;
     */
    private $translation;

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function setLocale(string $value): self
    {
        $this->locale = $value;

        return $this;
    }

    public function getTranslation(): string
    {
        return $this->translation;
    }

    public function setTranslation(string $value): self
    {
        $this->translation = $value;

        return $this;
    }
}
