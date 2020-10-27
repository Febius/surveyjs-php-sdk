<?php


namespace SurveyJsPhpSdk\Tests\Parser;


use PHPUnit\Framework\TestCase;
use SurveyJsPhpSdk\Configuration\ElementConfiguration;
use SurveyJsPhpSdk\Exception\ElementTypeNotFoundException;
use SurveyJsPhpSdk\Exception\InvalidElementConfigurationException;
use SurveyJsPhpSdk\Exception\MissingElementConfigurationException;
use SurveyJsPhpSdk\Exception\PageDataNotFoundException;
use SurveyJsPhpSdk\Model\ChoiceModel;
use SurveyJsPhpSdk\Model\Element\ChoiceElementAbstract;
use SurveyJsPhpSdk\Model\Element\CommentElement;
use SurveyJsPhpSdk\Model\Element\ElementInterface;
use SurveyJsPhpSdk\Model\PageModel;
use SurveyJsPhpSdk\Model\TemplateModel;
use SurveyJsPhpSdk\Model\TextModel;
use SurveyJsPhpSdk\Model\TranslationModel;
use SurveyJsPhpSdk\Parser\TemplateParser;
use SurveyJsPhpSdk\Tests\Fake\FakeCustomElementConfiguration;
use SurveyJsPhpSdk\Tests\Fake\FakeCustomElementModel;
use SurveyJsPhpSdk\Tests\Fake\FakeCustomElementParser;

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
                      "type": "custom_test_element_type",
                      "name": "question2"
                    },
                    {
                      "type": "text",
                      "name": "number question",
                      "inputType": "number",
                      "min": "1",
                      "max": "10",
                      "step": "1"
                    },
                    {
                      "type": "text",
                      "name": "default text question",
                      "placeHolder": {
                        "default": "placeHolder ...",
                        "it": "placeHolder it"
                      }
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

    private $testCaseSuccessWithTranslation = '
    {
              "pages": [
                {
                  "name": "page1",
                  "elements": [
                    {
                      "type": "radiogroup",
                      "name": "question1",
                      "title": {
                        "default": "First Question",
                        "it": "Prima domanda"
                      },
                      "isRequired": true,
                      "choices": [
                        {
                          "value": "1",
                          "text": {
                            "default": "good",
                            "it": "bene"
                          }
                        },
                        {
                          "value": "2",
                          "text": {
                            "default": "bad",
                            "it": "male"
                          }
                        }
                      ],
                      "choicesOrder": "asc"
                    },
                    {
                      "type": "custom_test_element_type",
                      "name": "question2"
                    }
                  ]
                },
                {
                  "name": "page2",
                  "elements": [
                    {
                      "type": "comment",
                      "name": "question3",
                      "title":  {
                        "default": "question3",
                        "it": "domanda 3"
                      },
                      "enableIf": "{question2} notempty"
                    },
                    {
                      "type": "radiogroup",
                      "name": "question4",
                      "title":  {
                        "default": "Fourth Question",
                        "it": "domanda 4"
                      },
                      "choices": [
                        {
                          "value": "1",
                          "text": {
                            "default": "yes",
                            "it": "si"
                          }
                        },
                        {
                          "value": "2",
                          "text": {
                            "default": "no",
                            "it": "no"
                          }
                        }
                      ],
                      "choicesOrder": "asc",
                      "otherText": {
                        "default": "other",
                        "it": "altro"
                      }
                    }
                  ]
                }
              ],
              "showNavigationButtons": "none",
              "showPageTitles": false,
              "showCompletedPage": false,
              "showQuestionNumbers": "off"
            }';

    private $testCasePageFail = '{
              "showNavigationButtons": "none",
              "showPageTitles": false,
              "showCompletedPage": false,
              "showQuestionNumbers": "off"
            }';

    private $testCaseElementTypeFail = '{
              "pages": [
                {
                  "name": "page1",
                  "elements": [
                    {
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
                    }
                  ]
                }
              ],
              "showNavigationButtons": "none",
              "showPageTitles": false,
              "showCompletedPage": false,
              "showQuestionNumbers": "off"
            }';

    private $testCaseElementConfigFail = '{
              "pages": [
                {
                  "name": "page1",
                  "elements": [
                    {
                      "type": "fake",
                      "name": "question1"
                    }
                  ]
                }
              ],
              "showNavigationButtons": "none",
              "showPageTitles": false,
              "showCompletedPage": false,
              "showQuestionNumbers": "off"
            }';

    /**
     * @var TemplateParser
     */
    private $sut;

    protected function setUp()
    {
        $conf = new FakeCustomElementConfiguration();
        $this->sut = new TemplateParser([$conf]);
    }

    public function testParseSuccess(){
        $model = $this->sut->parse($this->testCaseSuccess);

        $this->assertInstanceOf(TemplateModel::class, $model);
        $this->assertEquals('none', $model->getShowNavigationButtons());
        $this->assertEquals(false, $model->isShowPageTitles());
        $this->assertEquals(false, $model->isShowCompletedPage());
        $this->assertEquals('off', $model->getShowQuestionNumbers());

        foreach($model->getPages() as $page){

            $this->assertInstanceOf(PageModel::class, $page);

            foreach($page->getElements() as $element){

                $this->assertInstanceOf(ElementInterface::class, $element);

                if($element instanceof ChoiceElementAbstract){

                    foreach($element->getChoices() as $choice){
                        $this->assertInstanceOf(ChoiceModel::class, $choice);
                    }
                }
            }
        }
    }

    public function testParseSuccessWithTranslations(){
        $model = $this->sut->parse($this->testCaseSuccessWithTranslation);

        $this->assertInstanceOf(TemplateModel::class, $model);
        $this->assertEquals('none', $model->getShowNavigationButtons());
        $this->assertEquals(false, $model->isShowPageTitles());
        $this->assertEquals(false, $model->isShowCompletedPage());
        $this->assertEquals('off', $model->getShowQuestionNumbers());

        foreach($model->getPages() as $page){

            $this->assertInstanceOf(PageModel::class, $page);

            foreach($page->getElements() as $element){

                $this->assertInstanceOf(ElementInterface::class, $element);

                if($element instanceof ChoiceElementAbstract || $element instanceof CommentElement){
                    $this->assertInstanceOf(TextModel::class, $element->getTitle());
                    $this->assertInstanceOf(TranslationModel::class, $element->getTitle()->getTranslation('it'));
                }

                if($element instanceof ChoiceElementAbstract){

                    foreach($element->getChoices() as $choice){
                        $this->assertInstanceOf(ChoiceModel::class, $choice);
                        $this->assertInstanceOf(TextModel::class, $choice->getText());
                        $this->assertInstanceOf(TranslationModel::class, $choice->getText()->getTranslation('it'));
                    }
                }
            }
        }
    }

    public function testConstructRaiseInvalidElementConfigurationException()
    {
        $this->expectException(InvalidElementConfigurationException::class);

        new TemplateParser(['something clearly wrong']);
    }

    public function testParseRaisePageDataNotFoundException(){
        $this->expectException(PageDataNotFoundException::class);

        $this->sut->parse($this->testCasePageFail);
    }

    public function testParseRaiseElementTypeNotFoundException()
    {
        $this->expectException(ElementTypeNotFoundException::class);

        $this->sut->parse($this->testCaseElementTypeFail);
    }

    public function testParseRaiseMissingElementConfigurationException()
    {
        $this->expectException(MissingElementConfigurationException::class);

        $this->sut->parse($this->testCaseElementConfigFail);
    }
}
