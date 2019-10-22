<?php


namespace SurveyJsPhpSdk\Tests\Model;


use PHPUnit\Framework\TestCase;
use SurveyJsPhpSdk\Model\Element\CommentElement;
use SurveyJsPhpSdk\Model\ResultModel;

class CommentElementTest extends TestCase
{

    /**
     * @var CommentElement
     */
    private $comment;

    protected function setUp()
    {
        $this->comment = new CommentElement();
        $this->comment->setName('Great question');
    }

    public function testIsValidResult()
    {
        $result = new ResultModel();
        $result->setQuestion('Great question');
        $result->setAnswer('A great response');

        $this->assertTrue($this->comment->isValidResult($result));
    }

    public function testIsNotValidResult()
    {
        $result = new ResultModel();
        $result->setQuestion('Wrong question');
        $result->setAnswer('A great response');

        $this->assertFalse($this->comment->isValidResult($result));
    }
}
