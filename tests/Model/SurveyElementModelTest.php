<?php


namespace SurveyJsPhpSdk\Tests\Model;


use PHPUnit\Framework\TestCase;
use SurveyJsPhpSdk\Model\SurveyChoiceModel;
use SurveyJsPhpSdk\Model\SurveyElementModel;
use SurveyJsPhpSdk\Model\SurveyResultModel;

class SurveyElementModelTest extends TestCase
{
    /** @var SurveyElementModel */
    private $radioElement;
    /** @var SurveyElementModel */
    private $commentElement;

    protected function setUp()
    {
        $element1 = new SurveyElementModel();
        $element1->setName('q_1');
        $element1->setType('radiogroup');

        $choice1 = new SurveyChoiceModel();
        $choice1->setValue(1);

        $choice2 = new SurveyChoiceModel();
        $choice2->setValue(2);

        $element1->setChoices([$choice1, $choice2]);

        $this->radioElement = $element1;

        $element2 = new SurveyElementModel();
        $element2->setName('q_2');
        $element2->setType('comment');

        $this->commentElement = $element2;
    }

    public function testIsValidResultTrue(){
        $result1a = new SurveyResultModel();
        $result1a->setQuestion('q_1');
        $result1a->setAnswer(1);

        $result1b = new SurveyResultModel();
        $result1b->setQuestion('q_1');
        $result1b->setAnswer(2);

        $result2 = new SurveyResultModel();
        $result2->setQuestion('q_2');
        $result2->setAnswer('some comment about stuff');

        $this->assertTrue($this->radioElement->isValidResult($result1a));
        $this->assertTrue($this->radioElement->isValidResult($result1b));
        $this->assertTrue($this->commentElement->isValidResult($result2));
    }

    public function testIsValidResultFalse(){
        $result1a = new SurveyResultModel();
        $result1a->setQuestion('q_1');
        $result1a->setAnswer(3);

        $result1b = new SurveyResultModel();
        $result1b->setQuestion('q_15');
        $result1b->setAnswer(2);

        $this->assertFalse($this->radioElement->isValidResult($result1a));
        $this->assertFalse($this->radioElement->isValidResult($result1b));
    }
}