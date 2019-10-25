<?php


namespace SurveyJsPhpSdk\Tests\Parser;


use PHPUnit\Framework\TestCase;
use SurveyJsPhpSdk\Exception\InvalidSurveyResultException;
use SurveyJsPhpSdk\Model\ResultModel;
use SurveyJsPhpSdk\Parser\SurveyResultParser;
use SurveyJsPhpSdk\Parser\SurveyTemplateParser;

class SurveyResultParserTest extends TestCase
{

    private $templateJson = '
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
                      "type": "checkbox",
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
                      "type": "comment",
                      "name": "question3",
                      "title": "Question 3",
                      "enableIf": "{question2} notempty"
                    },
                    {
                      "type": "rating",
                      "name": "question4",
                      "title": "Fourth Question",
                      "rateMax": 6
                    }
                  ]
                }
              ],
              "showNavigationButtons": "none",
              "showPageTitles": false,
              "showCompletedPage": false,
              "showQuestionNumbers": "off"
            }';

    private $testCaseSuccess = '{"question1":"2","question2":"2","question3":"some extra notes","question4":"1"}';
    private $testCaseFail1 = '{"question1":"3","question2":"2","question3":"some extra notes","question4":"1"}';
    private $testCaseFail2 = '{"question5":"2","question2":"2","question3":"some extra notes","question4":"1"}';

    /**
     * @var SurveyResultParser
     */
    private $sut;


    protected function setUp()
    {
        $this->sut = new SurveyResultParser();
    }

    public function testParseToModel(){

        $models = $this->sut->parse((new SurveyTemplateParser)->parse($this->templateJson), $this->testCaseSuccess);

        $testCase = (array)json_decode($this->testCaseSuccess);

        $testQuestions = array_keys($testCase);

        $testAnswers = array_values($testCase);

        foreach($models as $index => $model){
            $this->assertInstanceOf(ResultModel::class, $model);
            $this->assertEquals($testQuestions[$index], $model->getQuestion());
            $this->assertEquals($testAnswers[$index], $model->getAnswer());
        }
    }

    public function testParseToModelRaiseExceptionWrongAnswer(){
        $this->expectException(InvalidSurveyResultException::class);

        $this->sut->parse((new SurveyTemplateParser)->parse($this->templateJson), $this->testCaseFail1);
    }

    public function testParseToModelRaiseExceptionWrongQuestion(){
        $this->expectException(InvalidSurveyResultException::class);

        $this->sut->parse((new SurveyTemplateParser)->parse($this->templateJson), $this->testCaseFail2);
    }
}
