<?php

namespace SurveyJsPhpSdk\Tests\Model;

use PHPUnit\Framework\TestCase;
use SurveyJsPhpSdk\Model\ChoiceModel;
use SurveyJsPhpSdk\Model\Element\CheckboxElement;
use SurveyJsPhpSdk\Model\ResultModel;

class CheckboxElementTest extends TestCase
{

    /**
     * @var CheckboxElement
     */
    private $checkbox;

    protected function setUp()
    {
        $choice1 = new ChoiceModel();
        $choice1->setValue('bad');

        $choice2 = new ChoiceModel();
        $choice2->setValue('good');

        $choice3 = new ChoiceModel();
        $choice3->setValue('average');

        $this->checkbox = new CheckboxElement();
        $this->checkbox->addChoice($choice1)->addChoice($choice2)->addChoice($choice3);
        $this->checkbox->setName('test');
        $this->checkbox->setHasOther(true);
    }

    public function testIsValidResultTrue()
    {
        $result = new ResultModel();
        $result->setQuestion('test');
        $result->setAnswer(['bad', 'good']);

        $this->assertTrue($this->checkbox->isValidResult($result));
    }
    public function testIsValidResultHasOtherTrue()
    {
        $result = new ResultModel();
        $result->setQuestion('test-Comment');
        $result->setAnswer("something else");

        $this->assertTrue($this->checkbox->isValidResult($result));
    }

    public function testIsValidResultFalseWrongQuestion()
    {
        $result = new ResultModel();
        $result->setQuestion('test_1');
        $result->setAnswer(['bad', 'good']);

        $this->assertFalse($this->checkbox->isValidResult($result));
    }

    public function testIsValidResultFalseWrongAnswer()
    {
        $result = new ResultModel();
        $result->setQuestion('test');
        $result->setAnswer(['bad', 'worst']);

        $this->assertFalse($this->checkbox->isValidResult($result));
    }
}