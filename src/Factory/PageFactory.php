<?php

namespace SurveyJsPhpSdk\Factory;

use SurveyJsPhpSdk\Model\PageModel;

class PageFactory
{
    public static function create(\stdClass $pageData): PageModel
    {
        $pageModel = new PageModel();

        $pageModel->setName($pageData->name);

        return $pageModel;
    }
}
