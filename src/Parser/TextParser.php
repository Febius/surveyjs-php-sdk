<?php


namespace SurveyJsPhpSdk\Parser;

use SurveyJsPhpSdk\Exception\LocaleNotSupportedException;
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
            $arrayData = get_object_vars($data);
            unset($arrayData['default']);

            foreach ($arrayData as $locale => $translation) {
                $translationParser = new TranslationParser();

                if(!in_array($locale, Localization::LOCALES)) {
                    throw new LocaleNotSupportedException($locale);
                }

                $textModel->setTranslation(
                    $translationParser->parse($locale, $translation)
                );
            }
        }

        return $textModel;
    }
}
