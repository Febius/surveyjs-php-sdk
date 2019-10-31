<?php


namespace SurveyJsPhpSdk\Parser;

use SurveyJsPhpSdk\Model\PageModel;

class PageParser
{
    public function parse(\stdClass $data): PageModel
    {
        $pageModel = new PageModel();

        $pageModel->setName($data->name);

        return $pageModel;
    }
}
