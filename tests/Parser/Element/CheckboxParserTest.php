<?php


namespace SurveyJsPhpSdk\Tests\Parser\Element;


use PHPUnit\Framework\TestCase;
use SurveyJsPhpSdk\Enum\ElementEnum;
use SurveyJsPhpSdk\Model\Element\CheckboxElement;
use SurveyJsPhpSdk\Model\SurveyChoiceModel;
use SurveyJsPhpSdk\Parser\Element\CheckboxParser;

class CheckboxParserTest extends TestCase
{

    /**
     * @var object
     */
    private $element;

    protected function setUp()
    {
        $choice1 = (object)[
            'text'  => 'choice 1',
            'value' => '1'
        ];

        $choice2 = (object)[
            'text'  => 'choice 2',
            'value' => '2'
        ];

        $this->element = (object)[
            'type'         => ElementEnum::CHECKBOX_TYPE,
            'name'         => 'element_2',
            'title'        => 'Element 2',
            'isRequired'   => false,
            'choicesOrder' => 'desc',
            'enableIf'     => 'implausible conditions',
            'choices'      => [$choice1, $choice2, 'item3']
        ];
    }

    public function testParseToModel()
    {
        $model = CheckboxParser::parseToModel($this->element);

        $this->assertInstanceOf(CheckboxElement::class, $model);

        foreach($model->getChoices() as $choice){
            $this->assertInstanceOf(SurveyChoiceModel::class, $choice);
        }
    }
}