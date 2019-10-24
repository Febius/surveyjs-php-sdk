<?php

namespace SurveyJsPhpSdk\Factory;

use SurveyJsPhpSdk\Configuration\ElementConfiguration;
use SurveyJsPhpSdk\Exception\MissingElementConfigurationException;
use SurveyJsPhpSdk\Model\Element\CheckboxElement;
use SurveyJsPhpSdk\Model\Element\CommentElement;
use SurveyJsPhpSdk\Model\Element\ElementInterface;
use SurveyJsPhpSdk\Model\Element\RadioGroupElement;
use SurveyJsPhpSdk\Model\Element\RatingElement;
use SurveyJsPhpSdk\Parser\Element\DefaultChoiceElementParser;
use SurveyJsPhpSdk\Parser\Element\DefaultElementParser;
use SurveyJsPhpSdk\Parser\Element\RatingElementParser;

class ElementFactory
{
    const CHECKBOX_TYPE = 'checkbox';
    const COMMENT_TYPE = 'comment';
    const RADIO_GROUP_TYPE = 'radiogroup';
    const RATING_TYPE = 'rating';

    /**
     * @param \stdClass $element
     * @param ElementConfiguration|null $configuration
     * @return ElementInterface
     * @throws MissingElementConfigurationException
     */
    public static function create(\stdClass $element, ?ElementConfiguration $configuration): ElementInterface
    {
        switch ($element->type) {
            case self::CHECKBOX_TYPE:
                $parser = new DefaultChoiceElementParser();
                return $parser->parse(new CheckboxElement(), $element);
            case self::COMMENT_TYPE:
                $parser = new DefaultElementParser();
                return $parser->parse(new CommentElement(), $element);
            case self::RADIO_GROUP_TYPE:
                $parser = new DefaultChoiceElementParser();
                return $parser->parse(new RadioGroupElement(), $element);
            case self::RATING_TYPE:
                $parser = new RatingElementParser();
                return $parser->parse(new RatingElement(), $element);
            default:
                if (null === $configuration) {
                    throw new MissingElementConfigurationException($element->type);
                }
                return $configuration->getParser()->parse($configuration->getElement(), $element);
        }
    }
}