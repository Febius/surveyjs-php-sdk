<?php


namespace SurveyJsPhpSdk\Tests\Factory;


use PHPUnit\Framework\TestCase;
use SurveyJsPhpSdk\Factory\ResultFactory;
use SurveyJsPhpSdk\Model\ResultModel;

class ResultFactoryTest extends TestCase
{

    public function testCreateSuccess()
    {
        $model = ResultFactory::create('question', 'answer');

        $this->assertInstanceOf(ResultModel::class, $model);
        $this->assertEquals('question', $model->getQuestion());
        $this->assertEquals('answer', $model->getAnswer());
    }
}