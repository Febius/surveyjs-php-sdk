<?php


namespace SurveyJsPhpSdk\Parser;

use SurveyJsPhpSdk\Exception\InvalidSurveyResultException;
use SurveyJsPhpSdk\Factory\ResultFactory;
use SurveyJsPhpSdk\Model\Element\ElementAbstract;
use SurveyJsPhpSdk\Model\PageModel;
use SurveyJsPhpSdk\Model\ResultModel;
use SurveyJsPhpSdk\Model\TemplateModel;

class SurveyResultParser
{
    /**
     * @param TemplateModel $survey
     * @param string              $jsonResults
     *
     * @return ResultModel[]
     * @throws InvalidSurveyResultException
     *
     */
    public function parse(TemplateModel $survey, string $jsonResults): array
    {
        $resultsModels = [];

        $results = (array)json_decode($jsonResults);

        foreach($results as $question => $result){
            $resultModel = ResultFactory::create($question, $result);

            if(!self::validateResult($survey->getPages(), $resultModel)) {
                throw new InvalidSurveyResultException();
            }

            $resultsModels[] = $resultModel;
        }

        return $resultsModels;
    }

    /**
     * @param PageModel[] $pages
     * @param ResultModel $result
     *
     * @return bool
     */
    private function validateResult(array $pages, ResultModel $result): bool
    {
        /**
         * @var PageModel $page
         */
        foreach($pages as $page){
            foreach($page->getElements() as $element){
                if($element instanceOf ElementAbstract && $element->isValidResult($result)) {
                    return true; //exit at first validation match
                }
            }
        }

        return false;
    }
}
