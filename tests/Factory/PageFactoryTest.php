<?php


namespace SurveyJsPhpSdk\Tests\Factory;


use PHPUnit\Framework\TestCase;
use SurveyJsPhpSdk\Factory\PageFactory;
use SurveyJsPhpSdk\Model\PageModel;

class PageFactoryTest extends TestCase
{

    /**
     * @var object
     */
    private $page;

    protected function setUp()
    {
        $this->page = (object)[
            'name' => 'test_page'
        ];
    }

    public function testCreateSuccess()
    {
        $model = PageFactory::create($this->page);

        $this->assertInstanceOf(PageModel::class, $model);
        $this->assertEquals('test_page', $model->getName());
    }
}