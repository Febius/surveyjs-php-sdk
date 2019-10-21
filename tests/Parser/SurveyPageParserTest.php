<?php


namespace SurveyJsPhpSdk\Tests\Parser;


use PHPUnit\Framework\TestCase;
use SurveyJsPhpSdk\Enum\ElementEnum;
use SurveyJsPhpSdk\Exception\ElementPropertyNotFoundException;
use SurveyJsPhpSdk\Model\Element\AbstractSurveyElementModel;
use SurveyJsPhpSdk\Model\Element\BaseSurveyElementModel;
use SurveyJsPhpSdk\Model\SurveyPageModel;
use SurveyJsPhpSdk\Parser\SurveyPageParser;

class SurveyPageParserTest extends TestCase
{
    /** @var \stdClass */
    private $testCaseFail;

    private $testCaseSuccess = [];

    protected function setUp()
    {
        $this->testCaseFail = (object) [
            'name' => 'page 1'
        ];

        $element1 = (object)[
            'type'         => ElementEnum::COMMENT_TYPE,
            'name'         => 'element_1',
            'title'        => 'Element 1',
            'isRequired'   => true,
        ];

        $element2 = (object)[
            'type'         => ElementEnum::COMMENT_TYPE,
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

        foreach($this->testCaseSuccess as $index => $page){
            $model = SurveyPageParser::parseToModel($page);
            $this->assertInstanceOf(SurveyPageModel::class, $model);
            $this->assertEquals($page->name, $model->getName());

            foreach($model->getElements() as $element){
                $this->assertInstanceOf(BaseSurveyElementModel::class, $element);
            }
        }
    }

    public function testParseToModelRaiseException(){
        $this->expectException(ElementPropertyNotFoundException::class);

        SurveyPageParser::parseToModel($this->testCaseFail);
    }
}