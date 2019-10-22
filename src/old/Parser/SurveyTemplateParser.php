<?php


namespace SurveyJsPhpSdk\Parser;


use SurveyJsPhpSdk\Configuration\CustomElementsConfiguration;
use SurveyJsPhpSdk\Exception\ElementPropertyNotFoundException;
use SurveyJsPhpSdk\Exception\InvalidParsedCustomElementModelException;
use SurveyJsPhpSdk\Exception\PagePropertyNotFoundException;
use SurveyJsPhpSdk\Exception\UnknownElementTypeException;
use SurveyJsPhpSdk\Model\TemplateModel;

class SurveyTemplateParser
{
    /**
     * @param string                           $jsonTemplate
     * @param CustomElementsConfiguration|null $configuration
     *
     * @return TemplateModel
     *@throws PagePropertyNotFoundException
     * @throws UnknownElementTypeException
     * @throws InvalidParsedCustomElementModelException
     *
     * @throws ElementPropertyNotFoundException
     */
    public static function parseToModel(string $jsonTemplate, ?CustomElementsConfiguration $configuration = null): TemplateModel
    {
        $decodedTemplate = json_decode($jsonTemplate);

        if(!isset($decodedTemplate->pages)) {
            throw new PagePropertyNotFoundException();
        }

        $surveyTemplateModel = new TemplateModel();

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
            $surveyTemplateModel->addPage(SurveyPageParser::parseToModel($page, $configuration));
        }

        return $surveyTemplateModel;
    }
}
