<?php


namespace SurveyJsPhpSdk\Parser;


use SurveyJsPhpSdk\Exception\ElementPropertyNotFoundException;
use SurveyJsPhpSdk\Model\SurveyPageModel;

class SurveyPageParser
{
    /**
     * @param array $pages
     *
     * @throws ElementPropertyNotFoundException
     *
     * @return SurveyPageModel[]
     */
    public static function parseToModel(array $pages): array
    {
        $pagesModels = [];

        foreach($pages as $page){
            $pageModel = new SurveyPageModel();

            $pageModel->setName($page->name);

            if(!isset($page->elements)){
                throw new ElementPropertyNotFoundException();
            }

            $pageModel->setElements(SurveyElementParser::parseToModel($page->elements));

            $pagesModels[] = $pageModel;
        }

        return $pagesModels;
    }
}