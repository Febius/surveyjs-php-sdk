<?php

namespace SurveyJsPhpSdk\Model;

use SurveyJsPhpSdk\Exception\LocaleNotSupportedException;
use SurveyJsPhpSdk\Localization\Localization;

class TextModel
{
    /**
     * @var string;
     */
    private $default;

    /**
     * @var TranslationModel[];
     */
    private $values;

    public function __construct()
    {
        $this->values = (object)[];
    }

    public function getDefaultValue(): string
    {
        return $this->default;
    }

    public function setDefaultValue(string $value): self
    {
        $this->default = $value;

        return $this;
    }

    /**
     * @param string $locale
     *
     * @return TranslationModel|string
     */
    public function getTranslation(string $locale)
    {
        if (!in_array($locale, Localization::LOCALES) || !isset($this->values->$locale)) {
            return $this->getDefaultValue();
        }

        return $this->values->$locale;
    }

    /**
     * @param TranslationModel $translation
     *
     * @throws LocaleNotSupportedException
     *
     * @return TextModel
     */
    public function setTranslation(TranslationModel $translation): self
    {
        $locale = $translation->getLocale();
        if(!in_array($locale, Localization::LOCALES)) {
            throw new LocaleNotSupportedException($locale);
        }

        $this->values->$locale = $translation;
        return $this;
    }
}
