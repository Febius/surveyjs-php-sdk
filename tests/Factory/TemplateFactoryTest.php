<?php


namespace SurveyJsPhpSdk\Tests\Factory;


use PHPUnit\Framework\TestCase;
use SurveyJsPhpSdk\Factory\TemplateFactory;
use SurveyJsPhpSdk\Model\TemplateModel;

class TemplateFactoryTest extends TestCase
{
    /**
     * @var object
     */
    private $template;

    protected function setUp()
    {
        $this->template = (object)[
            "showNavigationButtons" => "none",
            "showPageTitles" => false,
            "showCompletedPage" => false,
            "showQuestionNumbers" => "off"
        ];
    }

    public function testCreateSuccess(){
        $model = TemplateFactory::create($this->template);

        $this->assertInstanceOf(TemplateModel::class, $model);
        $this->assertEquals('none', $model->getShowNavigationButtons());
        $this->assertEquals(false, $model->isShowPageTitles());
        $this->assertEquals(false, $model->isShowCompletedPage());
        $this->assertEquals('off', $model->getShowQuestionNumbers());
    }
}