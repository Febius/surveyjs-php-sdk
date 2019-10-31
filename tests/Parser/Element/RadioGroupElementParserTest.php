<?php


namespace SurveyJsPhpSdk\Tests\Parser\Element;


use PHPUnit\Framework\TestCase;
use SurveyJsPhpSdk\Factory\ElementFactory;
use SurveyJsPhpSdk\Model\ChoiceModel;
use SurveyJsPhpSdk\Model\Element\RadioGroupElement;
use SurveyJsPhpSdk\Parser\Element\RadioGroupElementParser;

class RadioGroupElementParserTest extends TestCase
{

    /**
     * @var object
     */
    private $element;
    /**
     * @var RadioGroupElementParser
     */
    private $sut;

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
            'type'         => ElementFactory::RADIO_GROUP_TYPE,
            'name'         => 'element_2',
            'title'        => 'Element 2',
            'isRequired'   => false,
            'choicesOrder' => 'desc',
            'enableIf'     => 'implausible conditions',
            'choices'      => [$choice1, $choice2, 'item3']
        ];

        $this->sut = new RadioGroupElementParser();
    }

    public function testParseSuccess()
    {
        $model = $this->sut->parse($this->element);

        $this->assertInstanceOf(RadiogroupElement::class, $model);
        $this->assertEquals($this->element->name, $model->getName());
        $this->assertEquals($this->element->title, $model->getTitle());
        $this->assertEquals($this->element->isRequired, $model->isRequired());
        $this->assertEquals($this->element->enableIf, $model->getEnableIf());

        foreach($model->getChoices() as $choice){
            $this->assertInstanceOf(ChoiceModel::class, $choice);
        }
    }
}
