<?php


namespace SurveyJsPhpSdk\Tests\Parser\Element;


use PHPUnit\Framework\TestCase;
use SurveyJsPhpSdk\Exception\InvalidModelGivenToParserException;
use SurveyJsPhpSdk\Factory\ElementFactory;
use SurveyJsPhpSdk\Model\Element\CheckboxElement;
use SurveyJsPhpSdk\Model\Element\Choice\Choice;
use SurveyJsPhpSdk\Parser\Element\CheckboxElementParser;
use SurveyJsPhpSdk\Tests\Fake\FakeCustomElementModel;

class CheckboxElementParserTest extends TestCase
{
    /**
     * @var object
     */
    private $element;
    /**
     * @var CheckboxElementParser
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
            'type'         => ElementFactory::CHECKBOX_TYPE,
            'name'         => 'element_2',
            'title'        => 'Element 2',
            'isRequired'   => false,
            'choicesOrder' => 'desc',
            'enableIf'     => 'implausible conditions',
            'choices'      => [$choice1, $choice2, 'item3']
        ];

        $this->sut = new CheckboxElementParser();
    }

    public function testParseSuccess()
    {
        $model = $this->sut->parse(new CheckboxElement(), $this->element);

        $this->assertInstanceOf(CheckboxElement::class, $model);
        $this->assertEquals($this->element->name, $model->getName());
        $this->assertEquals($this->element->title, $model->getTitle());
        $this->assertEquals($this->element->isRequired, $model->isRequired());
        $this->assertEquals($this->element->enableIf, $model->getEnableIf());

        foreach($model->getChoices() as $choice){
            $this->assertInstanceOf(Choice::class, $choice);
        }
    }

    public function testParseRaiseException()
    {
        $model = new FakeCustomElementModel();

        $this->expectException(InvalidModelGivenToParserException::class);
        $this->expectExceptionMessage('Model passed to parser is invalid: ' . get_class($model) . ' expected: ' . CheckboxElement::class);

        $this->sut->parse($model, new \stdClass());
    }
}