<?php


namespace SurveyJsPhpSdk\Parser;

use SurveyJsPhpSdk\Model\TranslationModel;

class TranslationParser
{

    public function parse(string $locale, string $translation): TranslationModel
    {
        $translationModel = new TranslationModel();

        $translationModel->setLocale($locale);
        $translationModel->setTranslation($translation);

        return $translationModel;
    }
}
