<?php


namespace SurveyJsPhpSdk\Tests\Parser;


use PHPUnit\Framework\TestCase;
use SurveyJsPhpSdk\Exception\ElementPropertyNotFoundException;
use SurveyJsPhpSdk\Model\SurveyElementModel;
use SurveyJsPhpSdk\Model\SurveyPageModel;
use SurveyJsPhpSdk\Parser\SurveyPageParser;

class SurveyPageParserTest extends TestCase
{

    private $testCaseFail = [];

    private $testCaseSuccess = [];

    protected function setUp()
    {
        $fail = (object) [
            'name' => 'page 1'
        ];

        $this->testCaseFail[] = $fail;

        $element1 = (object)[
            'type'         => 'text',
            'name'         => 'element_1',
            'title'        => 'Element 1',
            'isRequired'   => true,
        ];

        $element2 = (object)[
            'type'         => 'text',
            'name'         => 'element_2',
            'title'        => 'Element 2',
            'isRequired'   => true,
        ];

        $page1 = (object)[
            'name' => 'page 1',
            'elements' => [$element1]
        ];

        $page2 = (object)[
            'name' => 'page 2',
            'elements' => [$element2]
        ];

        $this->testCaseSuccess = [$page1, $page2];
    }

    public function testParseToModel(){
        $models = SurveyPageParser::parseToModel($this->testCaseSuccess);

        foreach($this->testCaseSuccess as $index => $page){
            $this->assertInstanceOf(SurveyPageModel::class, $models[$index]);
            $this->assertEquals($page->name, $models[$index]->getName());

            foreach($models[$index]->getElements() as $element){
                $this->assertInstanceOf(SurveyElementModel::class, $element);
            }
        }
    }

    public function testParseToModelRaiseException(){
        $this->expectException(ElementPropertyNotFoundException::class);

        SurveyPageParser::parseToModel($this->testCaseFail);
    }
}