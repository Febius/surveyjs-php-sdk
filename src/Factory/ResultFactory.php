<?php


namespace SurveyJsPhpSdk\Factory;

use SurveyJsPhpSdk\Model\ResultModel;

class ResultFactory
{

    public static function create(string $question, string $result): ResultModel
    {
        $resultModel = new ResultModel();

        $resultModel->setQuestion($question);
        $resultModel->setAnswer($result);

        return $resultModel;
    }
}
