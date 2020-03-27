<?php


namespace SurveyJsPhpSdk\Parser;

use SurveyJsPhpSdk\Exception\InvalidSurveyResultException;
use SurveyJsPhpSdk\Model\Element\ElementAbstract;
use SurveyJsPhpSdk\Model\PageModel;
use SurveyJsPhpSdk\Model\ResultModel;
use SurveyJsPhpSdk\Model\TemplateModel;

class ResultParser
{
    /**
     * @param TemplateModel $survey
     * @param string              $jsonResults
     *
     * @throws InvalidSurveyResultException
     *
     * @return ResultModel[]
     */
    public function parse(TemplateModel $survey, string $jsonResults): array
    {
        $resultsModels = [];

        $results = (array)json_decode($jsonResults);

        foreach ($results as $question => $result) {
            $resultModel = new ResultModel();
            $resultModel->setQuestion($question)->setAnswer($result);

            if (!self::validateResult($survey->getPages(), $resultModel)) {
                throw new InvalidSurveyResultException(json_encode([$resultModel->getQuestion() => $resultModel->getAnswer()]));
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
        foreach ($pages as $page) {
            foreach ($page->getElements() as $element) {
                if ($element instanceof ElementAbstract && $element->isValidResult($result)) {
                    //exit at first validation match because there should be 1 to 1 correspondence between results and elements
                    return true;
                }
            }
        }

        return false;
    }
}
