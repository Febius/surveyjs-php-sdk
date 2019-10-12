<?php


namespace SurveyJsPhpSdk\Tests\Model;


use PHPUnit\Framework\TestCase;
use SurveyJsPhpSdk\Model\Element\AbstractSurveyElementModel;
use SurveyJsPhpSdk\Model\Element\RatingElement;
use SurveyJsPhpSdk\Model\SurveyChoiceModel;
use SurveyJsPhpSdk\Model\SurveyResultModel;

class RatingElementTest extends TestCase
{

    /**
     * @var AbstractSurveyElementModel
     */
    private $rating;

    protected function setUp()
    {
        $this->rating = new RatingElement();
        $this->rating->setName('Great rating question');

        $choice1 = new SurveyChoiceModel();
        $choice1->setText('1')->setValue('1');
        $choice2 = new SurveyChoiceModel();
        $choice2->setText('2')->setValue('2');

        $this->rating->addChoice($choice1);
        $this->rating->addChoice($choice2);
    }

    public function testIsValidResult()
    {
        $result = new SurveyResultModel();

        $result->setQuestion('Great rating question');
        $result->setAnswer('1');

        $this->assertTrue($this->rating->isValidResult($result));
    }

    public function testIsNotValidResultWrongQuestion()
    {
        $result = new SurveyResultModel();

        $result->setQuestion('Wrong rating question');
        $result->setAnswer('1');

        $this->assertFalse($this->rating->isValidResult($result));
    }

    public function testIsNotValidResultWrongAnswer()
    {
        $result = new SurveyResultModel();

        $result->setQuestion('Great rating question');
        $result->setAnswer('5');

        $this->assertFalse($this->rating->isValidResult($result));
    }
}