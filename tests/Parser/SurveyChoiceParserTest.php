<?php


namespace SurveyJsPhpSdk\Tests\Parser;


use PHPUnit\Framework\TestCase;
use SurveyJsPhpSdk\Model\SurveyChoiceModel;
use SurveyJsPhpSdk\Parser\SurveyChoiceParser;

class SurveyChoiceParserTest extends TestCase
{

    private $choicesToParse = [];

    protected function setUp()
    {
        $choice1 = (object)[
            'text' => 'choice 1',
            'value' => '1'
        ];

        $choice2 = (object)[
            'text' => 'choice 2',
            'value' => '2'
        ];

        $this->choicesToParse = [$choice1, $choice2];
    }

    public function testParseToModel(){

        $parsedChoices = SurveyChoiceParser::parseToModel($this->choicesToParse);

        foreach($this->choicesToParse as $index => $choice){
            $this->isInstanceOf(SurveyChoiceModel::class, $parsedChoices[$index]);
            $this->assertEquals($choice->text, $parsedChoices[$index]->getText());
            $this->assertEquals($choice->value, $parsedChoices[$index]->getValue());
        }
    }
}