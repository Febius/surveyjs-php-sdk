<?php


namespace SurveyJsPhpSdk\Tests\Model;


use PHPUnit\Framework\TestCase;
use SurveyJsPhpSdk\Model\ChoiceModel;
use SurveyJsPhpSdk\Model\Element\RatingElement;
use SurveyJsPhpSdk\Model\ResultModel;
use SurveyJsPhpSdk\Parser\TextParser;

class RatingElementTest extends TestCase
{

    /**
     * @var RatingElement
     */
    private $rating;

    /**
     * @var TextParser
     */
    private $textParser;

    protected function setUp()
    {
        $this->textParser = new TextParser();
        $this->rating = new RatingElement();
        $this->rating->setName('Great rating question');

        $choice1 = new ChoiceModel();
        $choice1->setText($this->textParser->parse('1'))->setValue('1');
        $choice2 = new ChoiceModel();
        $choice2->setText($this->textParser->parse('2'))->setValue('2');

        $this->rating->addChoice($choice1);
        $this->rating->addChoice($choice2);
    }

    public function testIsValidResult()
    {
        $result = new ResultModel();

        $result->setQuestion('Great rating question');
        $result->setAnswer('1');

        $this->assertTrue($this->rating->isValidResult($result));
    }

    public function testIsNotValidResultWrongQuestion()
    {
        $result = new ResultModel();

        $result->setQuestion('Wrong rating question');
        $result->setAnswer('1');

        $this->assertFalse($this->rating->isValidResult($result));
    }

    public function testIsNotValidResultWrongAnswer()
    {
        $result = new ResultModel();

        $result->setQuestion('Great rating question');
        $result->setAnswer('5');

        $this->assertFalse($this->rating->isValidResult($result));
    }
}
