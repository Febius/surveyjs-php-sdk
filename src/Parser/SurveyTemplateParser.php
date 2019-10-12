<?php


namespace SurveyJsPhpSdk\Parser;


use SurveyJsPhpSdk\Exception\ElementPropertyNotFoundException;
use SurveyJsPhpSdk\Exception\PagePropertyNotFoundException;
use SurveyJsPhpSdk\Model\SurveyTemplateModel;

class SurveyTemplateParser
{
    /**
     * @param string $jsonTemplate
     *
     * @throws PagePropertyNotFoundException
     * @throws ElementPropertyNotFoundException
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

        $surveyTemplateModel->setPages(SurveyPageParser::parseToModel($decodedTemplate->pages));

        return $surveyTemplateModel;
    }
}