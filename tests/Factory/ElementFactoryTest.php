<?php


namespace SurveyJsPhpSdk\Tests\Factory;


use PHPUnit\Framework\TestCase;
use SurveyJsPhpSdk\Configuration\ElementConfigurationInterface;
use SurveyJsPhpSdk\Exception\ElementConfigurationErrorException;
use SurveyJsPhpSdk\Exception\MissingElementConfigurationException;
use SurveyJsPhpSdk\Factory\ElementFactory;
use SurveyJsPhpSdk\Model\Element\CheckboxElement;
use SurveyJsPhpSdk\Model\Element\CommentElement;
use SurveyJsPhpSdk\Model\Element\RadioGroupElement;
use SurveyJsPhpSdk\Model\Element\RatingElement;
use SurveyJsPhpSdk\Model\Element\TextElement;
use SurveyJsPhpSdk\Parser\Element\CommentElementParser;
use SurveyJsPhpSdk\Tests\Fake\FakeCustomElementConfiguration;
use SurveyJsPhpSdk\Tests\Fake\FakeCustomElementModel;

class ElementFactoryTest extends TestCase
{

    /**
     * @var object
     */
    private $commentElement;
    /**
     * @var object
     */
    private $radiogroupElement;
    /**
     * @var object
     */
    private $ratingElement;
    /**
     * @var object
     */
    private $checkboxElement;
    /**
     * @var object
     */
    private $textElement;
    /**
     * @var object
     */
    private $customElement;
    /**
     * @var object
     */
    private $unknownElement;

    protected function setUp()
    {
        $this->commentElement = (object)[
            'type'         => ElementFactory::COMMENT_TYPE,
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

        $this->radiogroupElement = (object)[
            'type'         => ElementFactory::RADIO_GROUP_TYPE,
            'name'         => 'element_2',
            'title'        => 'Element 2',
            'isRequired'   => false,
            'choicesOrder' => 'desc',
            'enableIf'     => 'implausible conditions',
            'choices'      => [$choice1, $choice2, 'item3']
        ];

        $this->ratingElement = (object)[
            'type'         => ElementFactory::RATING_TYPE,
            'name'         => 'element_3',
            'title'        => 'Element 3',
            'isRequired'   => false,
            'enableIf'     => 'implausible conditions',
            'rateMax'      => 6
        ];

        $this->checkboxElement = (object)[
            'type'         => ElementFactory::CHECKBOX_TYPE,
            'name'         => 'element_2',
            'title'        => 'Element 2',
            'isRequired'   => false,
            'choicesOrder' => 'desc',
            'enableIf'     => 'implausible conditions',
            'choices'      => [$choice1, $choice2, 'item3']
        ];

        $this->textElement = (object)[
            'type'         => ElementFactory::TEXT_TYPE,
            'inputType'    => ElementFactory::NUMBER_TYPE,
            'name'         => 'element_4',
            'title'        => 'Element 4',
            'min'          => '1',
            'max'          => '2',
            'placeholder'  => 'insert value',
            'step'         => 1,
            'isRequired'   => true,
            'enableIf'     => 'plausible conditions',
        ];

        $this->customElement = (object)[
            'type'         => 'custom_test_element_type',
            'name'      => 'some_name'
        ];

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

    public function testCreateCommentElementSuccess(){
        $model = ElementFactory::create($this->commentElement, null);

        $this->assertInstanceOf(CommentElement::class, $model);
    }

    public function testCreateRadioGroupElementSuccess(){
        $model = ElementFactory::create($this->radiogroupElement, null);

        $this->assertInstanceOf(RadioGroupElement::class, $model);
    }

    public function testCreateRatingElementSuccess(){
        $model = ElementFactory::create($this->ratingElement, null);

        $this->assertInstanceOf(RatingElement::class, $model);
    }

    public function testCreateCheckboxElementSuccess(){
        $model = ElementFactory::create($this->checkboxElement, null);

        $this->assertInstanceOf(CheckboxElement::class, $model);
    }

    public function testCreateTextElementSuccess(){
        $model = ElementFactory::create($this->textElement, null);

        $this->assertInstanceOf(TextElement::class, $model);
    }

    public function testCreateCustomElementSuccess(){
        $conf = new FakeCustomElementConfiguration();

        $model = ElementFactory::create($this->customElement, $conf);

        $this->assertInstanceOf(FakeCustomElementModel::class, $model);
    }

    public function testCreateRaiseConfigurationErrorException(){
        $this->expectException(ElementConfigurationErrorException::class);
        $this->expectExceptionMessage('Configured model does not correspond to model returned by parser in configuration for type: custom_test_element_type');

        $conf = $this->createMock(ElementConfigurationInterface::class);
        $conf->method('getType')->willReturn('custom_test_element_type');
        $conf->method('getElement')->willReturn(new FakeCustomElementModel());
        $conf->method('getParser')->willReturn(new CommentElementParser());

        ElementFactory::create($this->customElement, $conf);
    }

    public function testCreateRaiseMissingConfigurationException(){
        $this->expectException(MissingElementConfigurationException::class);

        $conf = new FakeCustomElementConfiguration();

        ElementFactory::create($this->unknownElement, $conf);
    }
}