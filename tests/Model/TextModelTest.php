<?php

namespace SurveyJsPhpSdk\Tests\Model;

use PHPUnit\Framework\TestCase;
use SurveyJsPhpSdk\Exception\LocaleNotSupportedException;
use SurveyJsPhpSdk\Model\TextModel;
use SurveyJsPhpSdk\Parser\TranslationParser;

class TextModelTest extends TestCase
{
    /**
     * @var TextModel
     */
    private $sut;

    protected function setUp()
    {
        $this->sut = new TextModel();
    }

    public function testParseRaiseException()
    {
        $translationParser = new TranslationParser();
        $this->expectException(LocaleNotSupportedException::class);
        $this->expectExceptionMessage('Locale "NOT_SUPPORTED_LANG" is not supported');
        $this->sut->setTranslation(
            $translationParser->parse('NOT_SUPPORTED_LANG', 'translation')
        );
    }
}
