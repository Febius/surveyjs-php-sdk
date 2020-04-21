<?php

namespace SurveyJsPhpSdk\Tests\Model;

use PHPUnit\Framework\TestCase;
use SurveyJsPhpSdk\Model\ResultModel;

class ResultModelTest extends TestCase
{

    public function testIsMultipleChoiceAnswer()
    {
        $resultModel = new ResultModel();

        $resultModel->setAnswer([]);

        $this->assertTrue($resultModel->isMultipleChoiceAnswer());

        $resultModel->setAnswer("");

        $this->assertFalse($resultModel->isMultipleChoiceAnswer());
    }
}