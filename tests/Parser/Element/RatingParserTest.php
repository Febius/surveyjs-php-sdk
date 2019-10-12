<?php


namespace SurveyJsPhpSdk\Tests\Parser\Element;


use PHPUnit\Framework\TestCase;
use SurveyJsPhpSdk\Enum\ElementEnum;
use SurveyJsPhpSdk\Model\Element\RatingElement;
use SurveyJsPhpSdk\Model\SurveyChoiceModel;
use SurveyJsPhpSdk\Parser\Element\RatingParser;

class RatingParserTest extends TestCase
{

    /**
     * @var array
     */
    private $elements = [];

    protected function setUp()
    {
        $choice = (object)[
            'text'  => 'choice 6',
            'value' => '6'
        ];

        $this->elements[] = (object)[
            'type'         => ElementEnum::RATING_TYPE,
            'name'         => 'element_3',
            'title'        => 'Element 3',
            'isRequired'   => false,
            'enableIf'     => 'implausible conditions',
            'rateMax'      => 6
        ];

        $this->elements[] = (object)[
            'type'         => ElementEnum::RATING_TYPE,
            'name'         => 'element_3',
            'title'        => 'Element 3',
            'isRequired'   => false,
            'enableIf'     => 'implausible conditions',
            'rateValues'   => [
                '1',
                '2',
                '3',
                '4',
                '5',
                $choice
            ],
            'rateMax'      => 6
        ];
    }

    public function testParseToModel()
    {
        foreach($this->elements as $element){
            $model = RatingParser::parseToModel($element);

            $this->assertInstanceOf(RatingElement::class, $model);
            $this->assertEquals($element->rateMax, count($model->getChoices()));

            foreach ($model->getChoices() as $choice){
                $this->assertInstanceOf(SurveyChoiceModel::class, $choice);
            }
        }
    }
}