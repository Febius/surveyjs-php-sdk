<?php


namespace SurveyJsPhpSdk\Tests\Parser;


use PHPUnit\Framework\TestCase;
use SurveyJsPhpSdk\Model\TextModel;
use SurveyJsPhpSdk\Parser\TextParser;

class TextParserTest extends TestCase
{
    /**
     * @var object|string
     */
    private $text;
    /**
     * @var TextParser
     */
    private $sut;

    protected function setUp()
    {
        $this->sut = new TextParser();
    }

    public function testParseSuccessWithDefaultValue()
    {
        $this->text = (object)[
            'default' => 'def text',
            'it' => 'it text'
        ];

        $model = $this->sut->parse($this->text);

        $this->assertInstanceOf(TextModel::class, $model);
        $this->assertEquals('def text', $model->getDefaultValue());
        $this->assertEquals('it text', $model->getTranslatedValue('it'));
        $this->assertEquals('def text', $model->getTranslatedValue('wrong_locale'));
    }

    public function testParseSuccessWithoutDefaultValue()
    {
        $this->text = (object)[
            'it' => 'it text'
        ];

        $model = $this->sut->parse($this->text);

        $this->assertInstanceOf(TextModel::class, $model);
        $this->assertEquals('', $model->getDefaultValue());
        $this->assertEquals('it text', $model->getTranslatedValue('it'));
        $this->assertEquals('', $model->getTranslatedValue('wrong_locale'));
    }

    public function testParseSuccessWithString()
    {
        $this->text = 'def text';

        $model = $this->sut->parse($this->text);

        $this->assertInstanceOf(TextModel::class, $model);
        $this->assertEquals('def text', $model->getDefaultValue());
        $this->assertEquals('def text', $model->getTranslatedValue('it'));
        $this->assertEquals('def text', $model->getTranslatedValue('wrong_locale'));
    }

    public function testParseRaiseException()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('$data must be a string or an object.');
        $this->sut->parse(false);
    }
}