<?php


namespace SurveyJsPhpSdk\Parser;


use SurveyJsPhpSdk\Configuration\CustomElementsConfiguration;
use SurveyJsPhpSdk\Exception\ElementPropertyNotFoundException;
use SurveyJsPhpSdk\Exception\InvalidParsedCustomElementModelException;
use SurveyJsPhpSdk\Exception\UnknownElementTypeException;
use SurveyJsPhpSdk\Model\SurveyPageModel;

class SurveyPageParser
{
    /**
     * @param \stdClass                        $page
     * @param CustomElementsConfiguration|null $configuration
     *
     * @throws ElementPropertyNotFoundException
     * @throws UnknownElementTypeException
     * @throws InvalidParsedCustomElementModelException
     *
     * @return SurveyPageModel
     */
    public static function parseToModel(\stdClass $page, ?CustomElementsConfiguration $configuration = null): SurveyPageModel
    {
        $pageModel = new SurveyPageModel();

        $pageModel->setName($page->name);

        if(!isset($page->elements)) {
            throw new ElementPropertyNotFoundException();
        }

        foreach($page->elements as $element){
            $pageModel->addElement(SurveyElementParser::parseToModel($element, $configuration));
        }

        return $pageModel;
    }
}