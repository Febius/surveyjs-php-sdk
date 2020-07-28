<?php


namespace SurveyJsPhpSdk\Tests\Parser\Element;


use PHPStan\Testing\TestCase;
use SurveyJsPhpSdk\Exception\ElementNameNotFoundException;
use SurveyJsPhpSdk\Factory\ElementFactory;
use SurveyJsPhpSdk\Model\Element\CommentElement;
use SurveyJsPhpSdk\Model\TranslationModel;
use SurveyJsPhpSdk\Parser\Element\CommentElementParser;

class CommentElementParserTest extends TestCase
{

    /**
     * @var object
     */
    private $element;
    /**
     * @var CommentElementParser
     */
    private $sut;

    protected function setUp()
    {
        $this->element = (object)[
            'type'         => ElementFactory::COMMENT_TYPE,
            'name'         => 'element_1',
            'title'        => 'Element 1',
            'isRequired'   => true,
            'enableIf'     => 'plausible conditions'
        ];

        $this->sut = new CommentElementParser();
    }

    public function testParseSuccess()
    {
        $model  = $this->sut->parse($this->element);

        $this->assertInstanceOf(CommentElement::class, $model);
        $this->assertEquals($this->element->name, $model->getName());
        $this->assertEquals($this->element->title, $model->getTitle()->getDefaultValue());
        $this->assertEquals($this->element->isRequired, $model->isRequired());
        $this->assertEquals($this->element->enableIf, $model->getEnableIf());
    }

    public function testParseSuccessWithTranslation()
    {
        $this->element->title = (object)[
            'default' => 'def title',
            'en' => 'en title'
        ];
        $model  = $this->sut->parse($this->element);

        $this->assertInstanceOf(CommentElement::class, $model);
        $this->assertEquals($this->element->name, $model->getName());
        $this->assertEquals($this->element->title->default, $model->getTitle()->getDefaultValue());
        $this->assertInstanceOf(TranslationModel::class, $model->getTitle()->getTranslation('en'));
        $this->assertEquals($this->element->title->en, $model->getTitle()->getTranslation('en')->getTranslation());
        $this->assertEquals($this->element->isRequired, $model->isRequired());
        $this->assertEquals($this->element->enableIf, $model->getEnableIf());
    }

    public function testParseRaiseException()
    {
        $this->expectException(ElementNameNotFoundException::class);
        $this->expectExceptionMessage('The property "name" is required for all elements. This element has none: ' . ElementFactory::COMMENT_TYPE);

        unset($this->element->name);
        $this->sut->parse($this->element);
    }
}