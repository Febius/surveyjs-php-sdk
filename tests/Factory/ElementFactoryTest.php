<?php


namespace SurveyJsPhpSdk\Tests\Factory;


use PHPUnit\Framework\TestCase;
use SurveyJsPhpSdk\Configuration\ElementConfiguration;
use SurveyJsPhpSdk\Exception\MissingElementConfigurationException;
use SurveyJsPhpSdk\Factory\ElementFactory;
use SurveyJsPhpSdk\Model\Element\CheckboxElement;
use SurveyJsPhpSdk\Model\Element\CommentElement;
use SurveyJsPhpSdk\Model\Element\RadioGroupElement;
use SurveyJsPhpSdk\Model\Element\RatingElement;
use SurveyJsPhpSdk\Tests\Fake\FakeCustomElementModel;
use SurveyJsPhpSdk\Tests\Fake\FakeCustomElementParser;

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

    public function testCreateCustomElementSuccess(){
        $conf = new ElementConfiguration('custom_test_element_type', new FakeCustomElementModel(), new FakeCustomElementParser());

        $model = ElementFactory::create($this->customElement, $conf);

        $this->assertInstanceOf(FakeCustomElementModel::class, $model);
    }

    public function testCreateRaiseException(){
        $this->expectException(MissingElementConfigurationException::class);

        $conf = new ElementConfiguration('custom_test_element_type', new FakeCustomElementModel(), new FakeCustomElementParser());

        ElementFactory::create($this->unknownElement, $conf);
    }
}