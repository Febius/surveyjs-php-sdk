<?php


namespace SurveyJsPhpSdk\Tests\Parser;


use PHPUnit\Framework\TestCase;
use SurveyJsPhpSdk\Model\ChoiceModel;
use SurveyJsPhpSdk\Parser\SurveyChoiceParser;

class SurveyChoiceParserTest extends TestCase
{
    /**
     * @var object
     */
    private $choice;
    /**
     * @var SurveyChoiceParser
     */
    private $sut;

    protected function setUp()
    {
        $this->choice = (object)[
            'text'  => 'some_text',
            'value' => 'some_value'
        ];

        $this->sut = new SurveyChoiceParser();
    }

    public function testParseSuccess()
    {
        $model = $this->sut->parse($this->choice);

        $this->assertInstanceOf(ChoiceModel::class, $model);
        $this->assertEquals('some_text', $model->getText());
        $this->assertEquals('some_value', $model->getValue());
    }
}