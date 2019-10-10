<?php


namespace SurveyJsPhpSdk\Tests\Model;


use PHPUnit\Framework\TestCase;
use SurveyJsPhpSdk\Factory\ElementModelFactory;
use SurveyJsPhpSdk\Model\Element\AbstractSurveyElementModel;
use SurveyJsPhpSdk\Model\SurveyResultModel;

class CommentElementTest extends TestCase
{

    /**
     * @var AbstractSurveyElementModel
     */
    private $comment;

    protected function setUp()
    {
        $this->comment = ElementModelFactory::getModel(ElementModelFactory::COMMENT_TYPE);
        $this->comment->setName('Great question');
    }

    public function testIsValidResult()
    {
        $result = new SurveyResultModel();
        $result->setQuestion('Great question');
        $result->setAnswer('A great response');

        $this->assertTrue($this->comment->isValidResult($result));
    }

    public function testIsNotValidResult()
    {
        $result = new SurveyResultModel();
        $result->setQuestion('Wrong question');
        $result->setAnswer('A great response');

        $this->assertFalse($this->comment->isValidResult($result));
    }
}