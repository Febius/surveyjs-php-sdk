<?php


namespace SurveyJsPhpSdk\Tests\Parser;


use PHPUnit\Framework\TestCase;
use SurveyJsPhpSdk\Model\SurveyChoiceModel;
use SurveyJsPhpSdk\Parser\SurveyChoiceParser;

class SurveyChoiceParserTest extends TestCase
{

    public function testParseToModel(){

        $choice = (object)[
            'text' => 'choice 1',
            'value' => '1'
        ];

        $choiceModel = SurveyChoiceParser::parseToModel($choice);
        $this->assertInstanceOf(SurveyChoiceModel::class, $choiceModel);
        $this->assertEquals($choice->text, $choiceModel->getText());
        $this->assertEquals($choice->value, $choiceModel->getValue());
    }
}