<?php


namespace SurveyJsPhpSdk\Parser;

use SurveyJsPhpSdk\Localization\Localization;
use SurveyJsPhpSdk\Model\TextModel;

class TextParser
{

    /**
     * @param object|string $data
     *
     *
     * @return TextModel
     */
    public function parse($data): TextModel
    {
        if (!is_string($data) && !is_object($data)) {
            throw new \InvalidArgumentException('$data must be a string or an object.');
        }

        $textModel = new TextModel();

        $textModel->setDefaultValue(is_string($data) ? $data : $data->default ?? '');

        if(is_object($data)) {
            foreach (Localization::LOCALES as $supportedLocale) {
                $translationParser = new TranslationParser();
                $data->$supportedLocale && $textModel->setTranslation(
                    $translationParser->parse($supportedLocale, $data->$supportedLocale)
                );
            }
        }

        return $textModel;
    }
}
