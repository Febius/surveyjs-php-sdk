<?php


namespace SurveyJsPhpSdk\Tests\Configuration;


use PHPUnit\Framework\TestCase;
use SurveyJsPhpSdk\Configuration\CustomElementsConfiguration;
use SurveyJsPhpSdk\Configuration\SingleCustomElementConfiguration;
use SurveyJsPhpSdk\Exception\InvalidCustomElementModelException;
use SurveyJsPhpSdk\Exception\InvalidCustomElementParserException;
use SurveyJsPhpSdk\Tests\Fake\FakeCustomElementModel;
use SurveyJsPhpSdk\Tests\Fake\FakeCustomElementParser;

class CustomElementsConfigurationTest extends TestCase
{

    /**
     * @var CustomElementsConfiguration
     */
    private $sut;

    protected function setUp()
    {
        $this->sut = new CustomElementsConfiguration();
    }

    public function testAddConfig(){

        $this->sut->addConfig('test_type', FakeCustomElementModel::class, FakeCustomElementParser::class);

        $this->assertInstanceOf(SingleCustomElementConfiguration::class, $this->sut->getConfigByType('test_type'));
    }

    public function testAddConfigInvalidModelException(){
        $this->expectException(InvalidCustomElementModelException::class);

        $this->sut->addConfig('test_type', \stdClass::class, FakeCustomElementParser::class);
    }

    public function testAddConfigInvalidParserException(){
        $this->expectException(InvalidCustomElementParserException::class);

        $this->sut->addConfig('test_type', FakeCustomElementModel::class, \stdClass::class);
    }
}