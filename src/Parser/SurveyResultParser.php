<?php


namespace SurveyJsPhpSdk\Parser;


use SurveyJsPhpSdk\Exception\InvalidSurveyResultException;
use SurveyJsPhpSdk\Model\SurveyElementModel;
use SurveyJsPhpSdk\Model\SurveyPageModel;
use SurveyJsPhpSdk\Model\SurveyResultModel;
use SurveyJsPhpSdk\Model\SurveyTemplateModel;

class SurveyResultParser
{

    /**
     * @param SurveyTemplateModel $survey
     * @param string $jsonResults
     *
     * @return SurveyResultModel[]
     * @throws InvalidSurveyResultException
     */
    public static function parseToModel(SurveyTemplateModel $survey, string $jsonResults): array
    {
        $resultsModels = [];

        $results = json_decode($jsonResults);

        foreach($results as $result){
            $resultModel = new SurveyResultModel();

            $resultModel->setQuestion($result['question']);
            $resultModel->setAnswer($result['answer']);

            if(!self::validateResult($survey->getPages(), $resultModel)){
                throw new InvalidSurveyResultException();
            }

            $resultsModels[] = $resultModel;
        }

        return $resultsModels;
    }

    /**
     * @param array $pages
     * @param SurveyResultModel $result
     *
     * @return bool
     */
    public static function validateResult(array $pages, SurveyResultModel $result): bool
    {
        /** @var SurveyPageModel $page */
        foreach($pages as $page){
            /** @var SurveyElementModel $element */
            foreach($page->getElements() as $element){
                if($element->isValidResult($result)){
                    return true;
                }
            }
        }

        return false;
    }
}