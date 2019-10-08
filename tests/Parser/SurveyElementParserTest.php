<?php


namespace SurveyJsPhpSdk\Tests\Parser;


use PHPUnit\Framework\TestCase;
use SurveyJsPhpSdk\Model\SurveyChoiceModel;
use SurveyJsPhpSdk\Model\SurveyElementModel;
use SurveyJsPhpSdk\Parser\SurveyElementParser;

class SurveyElementParserTest extends TestCase
{
    private $elementsToParse = [];

    protected function setUp()
    {
        $element1 = (object)[
            'type'         => 'text',
            'name'         => 'element_1',
            'title'        => 'Element 1',
            'isRequired'   => true,
            'enableIf'     => 'plausible conditions',
        ];

        $choice1 = (object)[
            'text'  => 'choice 1',
            'value' => '1'
        ];

        $choice2 = (object)[
            'text'  => 'choice 2',
            'value' => '2'
        ];

        $element2 = (object)[
            'type'         => 'radiogroup',
            'name'         => 'element_2',
            'title'        => 'Element 2',
            'isRequired'   => false,
            'choicesOrder' => 'desc',
            'enableIf'     => 'implausible conditions',
            'choices'      => [$choice1, $choice2]
        ];

        $this->elementsToParse = [$element1, $element2];
    }

    public function testParseToModel(){
        $models = SurveyElementParser::parseToModel($this->elementsToParse);

        foreach($this->elementsToParse as $index => $element){
            $this->assertInstanceOf(SurveyElementModel::class, $models[$index]);
            $this->assertEquals($element->type, $models[$index]->getType());
            $this->assertEquals($element->name, $models[$index]->getName());
            $this->assertEquals($element->title, $models[$index]->getTitle());
            $this->assertEquals($element->isRequired, $models[$index]->isRequired());

            if(isset($element->choicesOrder)){
                $this->assertEquals($element->choicesOrder, $models[$index]->getChoicesOrder());

                foreach($models[$index]->getChoices() as $choice){
                    $this->assertInstanceOf(SurveyChoiceModel::class, $choice);
                }
            }
        }
    }
}