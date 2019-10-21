<?php


namespace SurveyJsPhpSdk\Configuration;


use SurveyJsPhpSdk\Exception\InvalidCustomElementModelException;
use SurveyJsPhpSdk\Exception\InvalidCustomElementParserException;
use SurveyJsPhpSdk\Model\Element\CustomElementModelInterface;
use SurveyJsPhpSdk\Parser\Element\CustomElementParserInterface;

class CustomElementsConfiguration
{
    /**
     * @var SingleCustomElementConfiguration[] 
     */
    private $configs;

    /**
     * @param string $type
     * @param string $modelClass
     * @param string $parserClass
     *
     * @throws InvalidCustomElementModelException
     * @throws InvalidCustomElementParserException
     */
    public function addConfig(string $type, string $modelClass, string $parserClass)
    {
        if(! class_implements($modelClass, CustomElementModelInterface::class)) {
            throw new InvalidCustomElementModelException();
        }

        if(! class_implements($parserClass, CustomElementParserInterface::class)) {
            throw new InvalidCustomElementParserException();
        }

        $config = new SingleCustomElementConfiguration();
        $config->setType($type)->setModel($modelClass)->setParser($parserClass);

        $this->configs[$type] = $config;
    }

    /**
     * @param string $type
     *
     * @return SingleCustomElementConfiguration|null
     */
    public function getConfigByType(string $type): ?SingleCustomElementConfiguration
    {
        return isset($this->configs[$type]) ? $this->configs[$type] : null;
    }
}