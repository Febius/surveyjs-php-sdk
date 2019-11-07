<?php


namespace SurveyJsPhpSdk\Tests\Parser\Element;


use PHPStan\Testing\TestCase;
use SurveyJsPhpSdk\Factory\ElementFactory;
use SurveyJsPhpSdk\Model\Element\CommentElement;
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
        $this->assertEquals($this->element->title, $model->getTitle());
        $this->assertEquals($this->element->isRequired, $model->isRequired());
        $this->assertEquals($this->element->enableIf, $model->getEnableIf());
    }
}