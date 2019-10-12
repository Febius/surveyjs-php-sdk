<?php


namespace SurveyJsPhpSdk\Parser;


use SurveyJsPhpSdk\Exception\ElementPropertyNotFoundException;
use SurveyJsPhpSdk\Exception\PagePropertyNotFoundException;
use SurveyJsPhpSdk\Exception\UnknownElementTypeException;
use SurveyJsPhpSdk\Model\SurveyTemplateModel;

class SurveyTemplateParser
{
    /**
     * @param string $jsonTemplate
     *
     * @throws ElementPropertyNotFoundException
     * @throws PagePropertyNotFoundException
     * @throws UnknownElementTypeException
     *
     * @return SurveyTemplateModel
     */
    public static function parseToModel(string $jsonTemplate): SurveyTemplateModel
    {
        $decodedTemplate = json_decode($jsonTemplate);

        if(!isset($decodedTemplate->pages)) {
            throw new PagePropertyNotFoundException();
        }

        $surveyTemplateModel = new SurveyTemplateModel();

        if(isset($decodedTemplate->showNavigationButtons)) {
            $surveyTemplateModel->setShowNavigationButtons($decodedTemplate->showNavigationButtons);
        }

        if(isset($decodedTemplate->showPageTitles)) {
            $surveyTemplateModel->setShowPageTitles($decodedTemplate->showPageTitles);
        }

        if(isset($decodedTemplate->showCompletedPage)) {
            $surveyTemplateModel->setShowCompletedPage($decodedTemplate->showCompletedPage);
        }

        if(isset($decodedTemplate->showQuestionNumbers)) {
            $surveyTemplateModel->setShowQuestionNumbers($decodedTemplate->showQuestionNumbers);
        }

        foreach($decodedTemplate->pages as $page){
            $surveyTemplateModel->addPage(SurveyPageParser::parseToModel($page));
        }

        return $surveyTemplateModel;
    }
}