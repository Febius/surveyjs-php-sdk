<?php


namespace SurveyJsPhpSdk\Tests\Factory;


use PHPUnit\Framework\TestCase;
use SurveyJsPhpSdk\Exception\UnknownElementTypeException;
use SurveyJsPhpSdk\Factory\ElementModelFactory;

class ElementModelFactoryTest extends TestCase
{

    public function testGetModel()
    {
        foreach(ElementModelFactory::ELEMENT_TYPES as $type){
            $model = ElementModelFactory::getModel($type);

            $this->assertInstanceOf(ElementModelFactory::TYPE_TO_CLASS_MAP[$type], $model);
        }
    }

    public function testGetModelRaiseException(){
        $this->expectException(UnknownElementTypeException::class);

        ElementModelFactory::getModel('a non existing type');
    }

}