<?php


namespace SurveyJsPhpSdk\Tests\Model;


use PHPUnit\Framework\TestCase;
use SurveyJsPhpSdk\Model\Element\TextElement;
use SurveyJsPhpSdk\Model\ResultModel;

class TextElementTest extends TestCase
{

    /**
     * @var TextElement
     */
    private $text;

    protected function setUp()
    {
        $this->text = new TextElement();
        $this->text->setName('Great question');
    }

    public function testIsValidResult()
    {
        $result = new ResultModel();
        $result->setQuestion('Great question');
        $result->setAnswer('A great response');

        $this->assertTrue($this->text->isValidResult($result));
    }

    public function testIsNotValidResult()
    {
        $result = new ResultModel();
        $result->setQuestion('Wrong question');
        $result->setAnswer('A great response');

        $this->assertFalse($this->text->isValidResult($result));
    }
}
