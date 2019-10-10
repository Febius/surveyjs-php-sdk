<?php


namespace SurveyJsPhpSdk\Model\Element;


use SurveyJsPhpSdk\Model\SurveyResultModel;

class CommentElement extends AbstractSurveyElementModel
{

    /**
     * @param SurveyResultModel $result
     *
     * @return bool
     */
    public function isValidResult(SurveyResultModel $result): bool
    {
         return $this->getName() === $result->getQuestion();
    }
}