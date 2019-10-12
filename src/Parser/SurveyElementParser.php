<?php


namespace SurveyJsPhpSdk\Parser;


use SurveyJsPhpSdk\Enum\ElementEnum;
use SurveyJsPhpSdk\Exception\UnknownElementTypeException;
use SurveyJsPhpSdk\Model\Element\AbstractSurveyElementModel;
use SurveyJsPhpSdk\Model\Element\CommentElement;
use SurveyJsPhpSdk\Parser\Element\CheckboxParser;
use SurveyJsPhpSdk\Parser\Element\RadiogroupParser;
use SurveyJsPhpSdk\Parser\Element\RatingParser;

class SurveyElementParser
{
    /**
     * @param \stdClass $element
     *
     * @throws UnknownElementTypeException
     *
     * @return AbstractSurveyElementModel
     */
    public static function parseToModel(\stdClass $element): AbstractSurveyElementModel
    {

            switch($element->type){
                case ElementEnum::COMMENT_TYPE:
                    $elementModel = new CommentElement();
                    break;

                case ElementEnum::CHECKBOX_TYPE:
                    $elementModel = CheckboxParser::parseToModel($element);
                    break;

                case ElementEnum::RADIOGROUP_TYPE:
                    $elementModel = RadiogroupParser::parseToModel($element);
                    break;

                case ElementEnum::RATING_TYPE:
                    $elementModel = RatingParser::parseToModel($element);
                    break;

                default:
                    throw new UnknownElementTypeException($element->type);
            }

            if(isset($element->name)) {
                $elementModel->setName($element->name);
            }

            if(isset($element->title)) {
                $elementModel->setTitle($element->title);
            }

            if(isset($element->isRequired)) {
                $elementModel->setRequired($element->isRequired);
            }

            if(isset($element->choicesOrder)) {
                $elementModel->setChoicesOrder($element->choicesOrder);
            }

            if(isset($element->enableIf)) {
                $elementModel->setEnableIf($element->enableIf);
            }

            return $elementModel;
    }
}