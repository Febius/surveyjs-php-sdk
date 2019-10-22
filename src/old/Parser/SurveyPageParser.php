<?php


namespace SurveyJsPhpSdk\Parser;


use SurveyJsPhpSdk\Configuration\CustomElementsConfiguration;
use SurveyJsPhpSdk\Exception\ElementPropertyNotFoundException;
use SurveyJsPhpSdk\Exception\InvalidParsedCustomElementModelException;
use SurveyJsPhpSdk\Exception\UnknownElementTypeException;
use SurveyJsPhpSdk\Model\PageModel;

class SurveyPageParser
{
    /**
     * @param \stdClass                        $page
     * @param CustomElementsConfiguration|null $configuration
     *
     * @return PageModel
     *@throws UnknownElementTypeException
     * @throws InvalidParsedCustomElementModelException
     *
     * @throws ElementPropertyNotFoundException
     */
    public static function parseToModel(\stdClass $page, ?CustomElementsConfiguration $configuration = null): PageModel
    {
        $pageModel = new PageModel();

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
