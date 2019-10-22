<?php


namespace SurveyJsPhpSdk\Parser;


use SurveyJsPhpSdk\Configuration\CustomElementsConfiguration;
use SurveyJsPhpSdk\Enum\ElementEnum;
use SurveyJsPhpSdk\Exception\InvalidParsedCustomElementModelException;
use SurveyJsPhpSdk\Exception\UnknownElementTypeException;
use SurveyJsPhpSdk\Model\Element\AbstractSurveyElementModel;
use SurveyJsPhpSdk\Model\Element\BaseSurveyElementModel;
use SurveyJsPhpSdk\Model\Element\CommentElement;
use SurveyJsPhpSdk\Model\Element\CustomElementModelInterface;
use SurveyJsPhpSdk\Parser\Element\DefaultChoiceElementParser;
use SurveyJsPhpSdk\Parser\Element\RadiogroupParser;
use SurveyJsPhpSdk\Parser\Element\RatingElementParser;

class SurveyElementParser
{
    /**
     * @param \stdClass                        $element
     * @param CustomElementsConfiguration|null $configuration
     *
     * @throws InvalidParsedCustomElementModelException
     * @throws UnknownElementTypeException
     *
     * @return BaseSurveyElementModel
     */
    public static function parseToModel(\stdClass $element, ?CustomElementsConfiguration $configuration = null): BaseSurveyElementModel
    {

            switch($element->type){
                case ElementEnum::COMMENT_TYPE:
                    $elementModel = new CommentElement();
                    break;

                case ElementEnum::CHECKBOX_TYPE:
                    $elementModel = DefaultChoiceElementParser::parseToModel($element);
                    break;

                case ElementEnum::RADIOGROUP_TYPE:
                    $elementModel = RadiogroupParser::parseToModel($element);
                    break;

                case ElementEnum::RATING_TYPE:
                    $elementModel = RatingElementParser::parseToModel($element);
                    break;

                default:
                    if(null === $config = $configuration->getConfigByType($element->type)) {
                        throw new UnknownElementTypeException($element->type);
                    }

                    $parser = $config->getParser();

                    $elementModel = $parser::parseToModel($element);

                    $model = $config->getModel();

                    if(! $elementModel instanceof $model) {
                        throw new InvalidParsedCustomElementModelException();
                    }
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
