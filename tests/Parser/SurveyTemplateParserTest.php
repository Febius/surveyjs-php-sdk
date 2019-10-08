<?php


namespace SurveyJsPhpSdk\Tests\Parser;


use PHPUnit\Framework\TestCase;
use SurveyJsPhpSdk\Exception\PagePropertyNotFoundException;
use SurveyJsPhpSdk\Model\SurveyPageModel;
use SurveyJsPhpSdk\Parser\SurveyTemplateParser;

class SurveyTemplateParserTest extends TestCase
{

    private $testCaseSuccess = '
    {
              "pages": [
                {
                  "name": "page1",
                  "elements": [
                    {
                      "type": "radiogroup",
                      "name": "question1",
                      "title": "First Question",
                      "isRequired": true,
                      "choices": [
                        {
                          "value": "1",
                          "text": "good"
                        },
                        {
                          "value": "2",
                          "text": "bad"
                        }
                      ],
                      "choicesOrder": "asc"
                    },
                    {
                      "type": "radiogroup",
                      "name": "question2",
                      "title": "Second Question",
                      "choices": [
                        {
                          "value": "1",
                          "text": "yes"
                        },
                        {
                          "value": "2",
                          "text": "no"
                        }
                      ],
                      "choicesOrder": "asc"
                    }
                  ]
                },
                {
                  "name": "page2",
                  "elements": [
                    {
                      "type": "radiogroup",
                      "name": "question3",
                      "title": "Third Question",
                      "isRequired": true,
                      "choices": [
                        {
                          "value": "1",
                          "text": "good"
                        },
                        {
                          "value": "2",
                          "text": "bad"
                        }
                      ],
                      "choicesOrder": "desc"
                    },
                    {
                      "type": "radiogroup",
                      "name": "question4",
                      "title": "Fourth Question",
                      "choices": [
                        {
                          "value": "1",
                          "text": "yes"
                        },
                        {
                          "value": "2",
                          "text": "no"
                        }
                      ],
                      "choicesOrder": "asc"
                    }
                  ]
                }
              ],
              "showNavigationButtons": "none",
              "showPageTitles": false,
              "showCompletedPage": false,
              "showQuestionNumbers": "off"
            }';

    private $testCaseFail = '{
              "showNavigationButtons": "none",
              "showPageTitles": false,
              "showCompletedPage": false,
              "showQuestionNumbers": "off"
            }';


    public function testParseToModel(){
        $model = SurveyTemplateParser::parseToModel($this->testCaseSuccess);

        $this->assertEquals('none', $model->getShowNavigationButtons());
        $this->assertEquals(false, $model->isShowPageTitles());
        $this->assertEquals(false, $model->isShowCompletedPage());
        $this->assertEquals('off', $model->getShowQuestionNumbers());

        foreach($model->getPages() as $page){
            $this->assertInstanceOf(SurveyPageModel::class, $page);
        }
    }

    public function testParseToModelRaiseException(){
        $this->expectException(PagePropertyNotFoundException::class);

        SurveyTemplateParser::parseToModel($this->testCaseFail);
    }
}