<?php

namespace SurveyJsPhpSdk\Factory;

use SurveyJsPhpSdk\Model\TemplateModel;

class TemplateFactory
{
    public static function create(\stdClass $templateData): TemplateModel
    {
        $templateModel = new TemplateModel();

        if (isset($templateData->showNavigationButtons)) {
            $templateModel->setShowNavigationButtons($templateData->showNavigationButtons);
        }

        if (isset($templateData->showPageTitles)) {
            $templateModel->setShowPageTitles($templateData->showPageTitles);
        }

        if (isset($templateData->showCompletedPage)) {
            $templateModel->setShowCompletedPage($templateData->showCompletedPage);
        }

        if (isset($templateData->showQuestionNumbers)) {
            $templateModel->setShowQuestionNumbers($templateData->showQuestionNumbers);
        }

        return $templateModel;
    }
}
