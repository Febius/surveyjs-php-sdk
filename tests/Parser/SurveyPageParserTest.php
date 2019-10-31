<?php


namespace SurveyJsPhpSdk\Tests\Parser;


use PHPUnit\Framework\TestCase;
use SurveyJsPhpSdk\Model\PageModel;
use SurveyJsPhpSdk\Parser\PageParser;

class SurveyPageParserTest extends TestCase
{
    /**
     * @var object
     */
    private $page;
    /**
     * @var PageParser
     */
    private $sut;

    protected function setUp()
    {
        $this->page = (object)[
            'name' => 'test_page'
        ];

        $this->sut = new PageParser();
    }

    public function testParseSuccess()
    {
        $model = $this->sut->parse($this->page);

        $this->assertInstanceOf(PageModel::class, $model);
        $this->assertEquals('test_page', $model->getName());
    }
}