<?php

namespace SurveyJsPhpSdk\Factory;

use SurveyJsPhpSdk\Configuration\ElementConfiguration;
use SurveyJsPhpSdk\Exception\MissingElementConfigurationException;
use SurveyJsPhpSdk\Model\Element\CheckboxElement;
use SurveyJsPhpSdk\Model\Element\CommentElement;
use SurveyJsPhpSdk\Model\Element\ElementInterface;
use SurveyJsPhpSdk\Model\Element\RadioGroupElement;
use SurveyJsPhpSdk\Model\Element\RatingElement;
use SurveyJsPhpSdk\Parser\Element\CheckboxElementParser;
use SurveyJsPhpSdk\Parser\Element\CommentElementParser;
use SurveyJsPhpSdk\Parser\Element\DefaultChoiceElementParser;
use SurveyJsPhpSdk\Parser\Element\DefaultSurveyElementParserAbstract;
use SurveyJsPhpSdk\Parser\Element\RadiogroupElementParser;
use SurveyJsPhpSdk\Parser\Element\RatingElementParser;

class ElementFactory
{
    public const CHECKBOX_TYPE = 'checkbox';
    public const COMMENT_TYPE = 'comment';
    public const RADIO_GROUP_TYPE = 'radiogroup';
    public const RATING_TYPE = 'rating';

    public const KNOWN_TYPES = [
        self::COMMENT_TYPE,
        self::CHECKBOX_TYPE,
        self::RADIO_GROUP_TYPE,
        self::RATING_TYPE
    ];

    /**
     * @param \stdClass $element
     * @param ElementConfiguration|null $configuration
     *
     * @throws MissingElementConfigurationException
     *
     * @return ElementInterface
     */
    public static function create(\stdClass $element, ?ElementConfiguration $configuration): ElementInterface
    {
        switch ($element->type) {
            case self::CHECKBOX_TYPE:
                $parser = new CheckboxElementParser();
                return $parser->parse(new CheckboxElement(), $element);
            case self::COMMENT_TYPE:
                $parser = new CommentElementParser();
                return $parser->parse(new CommentElement(), $element);
            case self::RADIO_GROUP_TYPE:
                $parser = new RadiogroupElementParser();
                return $parser->parse(new RadioGroupElement(), $element);
            case self::RATING_TYPE:
                $parser = new RatingElementParser();
                return $parser->parse(new RatingElement(), $element);
            default:
                if ($element->type === $configuration->getType()) {
                    return $configuration->getParser()->parse($configuration->getElement(), $element);
                }
                throw new MissingElementConfigurationException($element->type);
        }
    }
}
