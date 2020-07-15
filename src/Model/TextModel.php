<?php

namespace SurveyJsPhpSdk\Model;

use SurveyJsPhpSdk\Exception\LocaleNotSupportedException;
use SurveyJsPhpSdk\Localization\Localization;

class TextModel
{
    /**
     * @var object;
     */
    private $values;

    public function __construct()
    {
        $this->values = (object)[];
    }

    public function getDefaultValue(): string
    {
        return $this->values->default;
    }

    public function setDefaultValue(string $value): self
    {
        $this->values->default = $value;

        return $this;
    }

    public function getTranslatedValue(string $locale): string
    {
        if (!in_array($locale, Localization::LOCALES) || !isset($this->values->$locale)) {
            return $this->getDefaultValue();
        }

        return $this->values->$locale;
    }

    /**
     * @param string $locale
     * @param string $value
     *
     * @throws LocaleNotSupportedException
     *
     * @return TextModel
     */
    public function setTranslatedValue(string $locale, string $value): self
    {
        if(!in_array($locale, Localization::LOCALES)) {
            throw new LocaleNotSupportedException($locale);
        }

        $this->values->$locale = $value;
        return $this;
    }
}
