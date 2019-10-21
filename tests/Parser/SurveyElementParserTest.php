<?php


namespace SurveyJsPhpSdk\Tests\Parser;


use PHPUnit\Framework\TestCase;
use SurveyJsPhpSdk\Configuration\CustomElementsConfiguration;
use SurveyJsPhpSdk\Enum\ElementEnum;
use SurveyJsPhpSdk\Exception\InvalidParsedCustomElementModelException;
use SurveyJsPhpSdk\Exception\UnknownElementTypeException;
use SurveyJsPhpSdk\Model\Element\CheckboxElement;
use SurveyJsPhpSdk\Model\Element\CommentElement;
use SurveyJsPhpSdk\Model\Element\RadiogroupElement;
use SurveyJsPhpSdk\Model\Element\RatingElement;
use SurveyJsPhpSdk\Parser\SurveyElementParser;
use SurveyJsPhpSdk\Tests\Fake\FakeCustomElementModel;
use SurveyJsPhpSdk\Tests\Fake\FakeCustomElementParser;
use SurveyJsPhpSdk\Tests\Fake\FakeCustomElementParserWrong;

class SurveyElementParserTest extends TestCase
{
    /** @var array */
    private $elementsToParse = [];

    /** @var \StdClass */
    private $unknownElement;
    /**
     * @var object
     */
    private $customElement;

    protected function setUp()
    {
        $element1 = (object)[
            'type'         => ElementEnum::COMMENT_TYPE,
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
            'type'         => ElementEnum::RADIOGROUP_TYPE,
            'name'         => 'element_2',
            'title'        => 'Element 2',
            'isRequired'   => false,
            'choicesOrder' => 'desc',
            'enableIf'     => 'implausible conditions',
            'choices'      => [$choice1, $choice2, 'item3']
        ];

        $element3 = (object)[
            'type'         => ElementEnum::RATING_TYPE,
            'name'         => 'element_3',
            'title'        => 'Element 3',
            'isRequired'   => false,
            'enableIf'     => 'implausible conditions',
            'rateMax'      => 6
        ];

        $element4 = (object)[
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
                (object)[
                    'text'  => 'choice 6',
                    'value' => '6'
                ]
            ],
            'rateMax'      => 6
        ];

        $element5 = (object)[
            'type'         => ElementEnum::CHECKBOX_TYPE,
            'name'         => 'element_2',
            'title'        => 'Element 2',
            'isRequired'   => false,
            'choicesOrder' => 'desc',
            'enableIf'     => 'implausible conditions',
            'choices'      => [$choice1, $choice2, 'item3']
        ];

        $this->customElement = (object)[
            'type'         => 'custom_test_element_type',
            'content'      => 'some content for the element'
        ];

        $this->elementsToParse = [$element1, $element2, $element3, $element4, $element5];

        $this->unknownElement = (object)[
            'type'         => 'unknown_element',
            'name'         => 'element_2',
            'title'        => 'Element 2',
            'isRequired'   => false,
            'choicesOrder' => 'desc',
            'enableIf'     => 'implausible conditions',
            'choices'      => [$choice1, $choice2, 'item3']
        ];
    }

    public function testParseToModel(){

        foreach($this->elementsToParse as $index => $element){
            $model = SurveyElementParser::parseToModel($element);
            $this->assertEquals($element->name, $model->getName());
            $this->assertEquals($element->title, $model->getTitle());
            $this->assertEquals($element->isRequired, $model->isRequired());
            $this->assertEquals($element->enableIf, $model->getEnableIf());

            if(isset($element->choicesOrder)){
                $this->assertEquals($element->choicesOrder, $model->getChoicesOrder());
            }

            switch($element->type){
                case ElementEnum::COMMENT_TYPE:
                    $this->assertInstanceOf(CommentElement::class, $model);
                    break;
                case ElementEnum::CHECKBOX_TYPE:
                    $this->assertInstanceOf(CheckboxElement::class, $model);
                    break;
                case ElementEnum::RADIOGROUP_TYPE:
                    $this->assertInstanceOf(RadiogroupElement::class, $model);
                    break;
                case ElementEnum::RATING_TYPE:
                    $this->assertInstanceOf(RatingElement::class, $model);
                    break;
            }
        }
    }

    public function testParseToModelWithCustomElement(){
        $conf = new CustomElementsConfiguration();
        $conf->addConfig('custom_test_element_type', FakeCustomElementModel::class, FakeCustomElementParser::class);

        $model = SurveyElementParser::parseToModel($this->customElement, $conf);

        $this->assertInstanceOf(FakeCustomElementModel::class, $model);
    }

    public function testParseToModelWithCustomElementRaiseException(){

        $this->expectException(InvalidParsedCustomElementModelException::class);

        $conf = new CustomElementsConfiguration();
        $conf->addConfig('custom_test_element_type', FakeCustomElementModel::class, FakeCustomElementParserWrong::class);

        SurveyElementParser::parseToModel($this->customElement, $conf);
    }

    public function parseToModelRaiseException()
    {
        $this->expectException(UnknownElementTypeException::class);

        SurveyElementParser::parseToModel($this->unknownElement);
    }
}