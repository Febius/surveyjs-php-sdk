<?php


namespace SurveyJsPhpSdk\Factory;


use SurveyJsPhpSdk\Exception\UnknownElementTypeException;
use SurveyJsPhpSdk\Model\Element\AbstractSurveyElementModel;
use SurveyJsPhpSdk\Model\Element\CheckboxElement;
use SurveyJsPhpSdk\Model\Element\CommentElement;
use SurveyJsPhpSdk\Model\Element\RadiogroupElement;
use SurveyJsPhpSdk\Model\Element\RatingElement;

class ElementModelFactory
{

    public const COMMENT_TYPE = 'comment';
    public const RADIOGROUP_TYPE = 'radiogroup';
    public const RATING_TYPE = 'rating';
    public const CHECKBOX_TYPE = 'checkbox';

    public const ELEMENT_TYPES = [self::COMMENT_TYPE, self::RADIOGROUP_TYPE, self::RATING_TYPE, self::CHECKBOX_TYPE];

    public const TYPE_TO_CLASS_MAP = [
        self::COMMENT_TYPE      => CommentElement::class,
        self::RADIOGROUP_TYPE   => RadiogroupElement::class,
        self::RATING_TYPE       => RatingElement::class,
        self::CHECKBOX_TYPE     => CheckboxElement::class
    ];

    /**
     * @param string $type
     *
     * @throws UnknownElementTypeException
     *
     * @return AbstractSurveyElementModel
     */
    public static function getModel(string $type): AbstractSurveyElementModel
    {
        if(!in_array($type, self::ELEMENT_TYPES)){
            throw new UnknownElementTypeException();
        }

        $class = self::TYPE_TO_CLASS_MAP[$type];

        return new $class;
    }
}