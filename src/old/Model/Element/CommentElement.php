<?php


namespace SurveyJsPhpSdk\Model\Element;


use SurveyJsPhpSdk\Model\ResultModel;

class CommentElement extends AbstractSurveyElementModel
{

    /**
     * @param ResultModel $result
     *
     * @return bool
     */
    public function isValidResult(ResultModel $result): bool
    {
         return $this->getName() === $result->getQuestion();
    }
}
