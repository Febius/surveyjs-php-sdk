<?php


namespace SurveyJsPhpSdk\Parser;


use SurveyJsPhpSdk\Exception\ElementPropertyNotFoundException;
use SurveyJsPhpSdk\Exception\UnknownElementTypeException;
use SurveyJsPhpSdk\Model\SurveyPageModel;

class SurveyPageParser
{
    /**
     * @param \stdClass $page
     *
     * @throws ElementPropertyNotFoundException
     * @throws UnknownElementTypeException
     *
     * @return SurveyPageModel
     */
    public static function parseToModel(\stdClass $page): SurveyPageModel
    {
        $pageModel = new SurveyPageModel();

        $pageModel->setName($page->name);

        if(!isset($page->elements)) {
            throw new ElementPropertyNotFoundException();
        }

        foreach($page->elements as $element){
            $pageModel->addElement(SurveyElementParser::parseToModel($element));
        }

        return $pageModel;
    }
}