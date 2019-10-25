<?php


namespace SurveyJsPhpSdk\Tests\Factory;


use PHPUnit\Framework\TestCase;
use SurveyJsPhpSdk\Factory\ChoiceFactory;
use SurveyJsPhpSdk\Model\Element\Choice\Choice;

class ChoiceFactoryTest extends TestCase
{

    /**
     * @var object
     */
    private $choice;

    protected function setUp()
    {
        $this->choice = (object)[
            'text'  => 'some_text',
            'value' => 'some_value'
        ];
    }

    public function testCreateSuccess()
    {
        $model = ChoiceFactory::create($this->choice);

        $this->assertInstanceOf(Choice::class, $model);
        $this->assertEquals('some_text', $model->getText());
        $this->assertEquals('some_value', $model->getValue());
    }
}