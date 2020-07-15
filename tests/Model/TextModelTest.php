<?php

namespace SurveyJsPhpSdk\Tests\Model;

use PHPUnit\Framework\TestCase;
use SurveyJsPhpSdk\Exception\LocaleNotSupportedException;
use SurveyJsPhpSdk\Model\TextModel;

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
        $this->expectException(LocaleNotSupportedException::class);
        $this->expectExceptionMessage('Locale "NOT_SUPPORTED_LOCALE" is not supported');
        $this->sut->setTranslatedValue('NOT_SUPPORTED_LOCALE', 'text');
    }
}
