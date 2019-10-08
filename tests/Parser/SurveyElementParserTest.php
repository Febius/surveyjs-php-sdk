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
            'type'         => 'comment',
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
            'choices'      => [$choice1, $choice2, 'item3']
        ];

        $element3 = (object)[
            'type'         => 'rating',
            'name'         => 'element_3',
            'title'        => 'Element 3',
            'isRequired'   => false,
            'enableIf'     => 'implausible conditions',
            'rateMax'      => 6
        ];

        $element4 = (object)[
            'type'         => 'rating',
            'name'         => 'element_3',
            'title'        => 'Element 3',
            'isRequired'   => false,
            'enableIf'     => 'implausible conditions',
            'rateValues'   => [
                '1',
                '2',
                '3',
                '4',
                $choice2
            ],
            'rateMax'      => 6
        ];

        $element5 = (object)[
            'type'         => 'checkbox',
            'name'         => 'element_2',
            'title'        => 'Element 2',
            'isRequired'   => false,
            'choicesOrder' => 'desc',
            'enableIf'     => 'implausible conditions',
            'choices'      => [$choice1, $choice2, 'item3']
        ];

        $this->elementsToParse = [$element1, $element2, $element3, $element4, $element5];
    }

    public function testParseToModel(){
        $models = SurveyElementParser::parseToModel($this->elementsToParse);

        foreach($this->elementsToParse as $index => $element){
            $this->assertInstanceOf(SurveyElementModel::class, $models[$index]);
            $this->assertEquals($element->type, $models[$index]->getType());
            $this->assertEquals($element->name, $models[$index]->getName());
            $this->assertEquals($element->title, $models[$index]->getTitle());
            $this->assertEquals($element->isRequired, $models[$index]->isRequired());

            if(in_array($element->type, ['rating', 'checkbox', 'radiogroup'])){

                foreach($models[$index]->getChoices() as $choice){
                    $this->assertInstanceOf(SurveyChoiceModel::class, $choice);
                }
            }
        }
    }
}