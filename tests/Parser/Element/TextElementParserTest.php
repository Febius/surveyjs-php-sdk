<?php


namespace SurveyJsPhpSdk\Tests\Parser\Element;


use PHPStan\Testing\TestCase;
use SurveyJsPhpSdk\Exception\ElementNameNotFoundException;
use SurveyJsPhpSdk\Exception\InvalidTextElementTypeException;
use SurveyJsPhpSdk\Factory\ElementFactory;
use SurveyJsPhpSdk\Model\Element\CommentElement;
use SurveyJsPhpSdk\Model\Element\TextElement;
use SurveyJsPhpSdk\Model\TranslationModel;
use SurveyJsPhpSdk\Parser\Element\TextElementParser;

class TextElementParserTest extends TestCase
{

    /**
     * @var object
     */
    private $element;
    /**
     * @var TextElementParser
     */
    private $sut;

    protected function setUp()
    {
        $this->element = (object)[
            'type'         => ElementFactory::TEXT_TYPE,
            'name'         => 'element_1',
            'title'        => 'Element 1',
            'placeholder'  => 'placeholder 1',
            'inputType'    => ElementFactory::NUMBER_TYPE,
            'min'          => '0',
            'max'          => '100',
            'step'         => 20,
            'isRequired'   => true,
            'enableIf'     => 'plausible conditions'
        ];

        $this->sut = new TextElementParser();
    }

    public function testParseSuccess()
    {
        $model  = $this->sut->parse($this->element);

        $this->assertInstanceOf(TextElement::class, $model);
        $this->assertEquals($this->element->name, $model->getName());
        $this->assertEquals($this->element->title, $model->getTitle()->getDefaultValue());
        $this->assertEquals($this->element->isRequired, $model->isRequired());
        $this->assertEquals($this->element->enableIf, $model->getEnableIf());
        $this->assertEquals($this->element->inputType, $model->getInputType());
        $this->assertEquals($this->element->placeholder, $model->getPlaceholder()->getDefaultValue());
        $this->assertEquals($this->element->min, $model->getMin());
        $this->assertEquals($this->element->max, $model->getMax());
        $this->assertEquals($this->element->step, $model->getStep());
    }

    public function testParseSuccessWithTranslation()
    {
        $this->element->title = (object)[
            'default' => 'def title',
            'en' => 'en title'
        ];
        $this->element->placeholder = (object)[
            'default' => 'def placeholder',
            'en' => 'en placeholder'
        ];
        $model  = $this->sut->parse($this->element);

        $this->assertInstanceOf(TextElement::class, $model);
        $this->assertEquals($this->element->name, $model->getName());
        $this->assertEquals($this->element->title->default, $model->getTitle()->getDefaultValue());
        $this->assertInstanceOf(TranslationModel::class, $model->getTitle()->getTranslation('en'));
        $this->assertEquals($this->element->title->en, $model->getTitle()->getTranslation('en')->getTranslation());
        $this->assertEquals($this->element->placeholder->default, $model->getPlaceholder()->getDefaultValue());
        $this->assertInstanceOf(TranslationModel::class, $model->getPlaceholder()->getTranslation('en'));
        $this->assertEquals($this->element->placeholder->en, $model->getPlaceholder()->getTranslation('en')->getTranslation());
        $this->assertEquals($this->element->isRequired, $model->isRequired());
        $this->assertEquals($this->element->enableIf, $model->getEnableIf());
        $this->assertEquals($this->element->inputType, $model->getInputType());
        $this->assertEquals($this->element->min, $model->getMin());
        $this->assertEquals($this->element->max, $model->getMax());
        $this->assertEquals($this->element->step, $model->getStep());
    }

    public function testParseRaiseException()
    {
        $this->expectException(ElementNameNotFoundException::class);
        $this->expectExceptionMessage('The property "name" is required for all elements. This element has none: ' . ElementFactory::TEXT_TYPE);

        unset($this->element->name);
        $this->sut->parse($this->element);
    }

    public function testParseRaiseInvalidTypeException()
    {
        $this->expectException(InvalidTextElementTypeException::class);
        $this->expectExceptionMessage('The given text element type "invalidType" is not supported');

        $this->element->inputType = 'invalidType';
        $this->sut->parse($this->element);
    }
}