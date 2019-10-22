<?php


namespace SurveyJsPhpSdk\Enum;


class ElementEnum
{
    /**
     * @var string  
     */
    public const COMMENT_TYPE = 'comment';
    /**
     * @var string  
     */
    public const RADIOGROUP_TYPE = 'radiogroup';
    /**
     * @var string  
     */
    public const RATING_TYPE = 'rating';
    /**
     * @var string  
     */
    public const CHECKBOX_TYPE = 'checkbox';
    /**
     * @var array  
     */
    public const ELEMENT_TYPES = [self::COMMENT_TYPE, self::RADIOGROUP_TYPE, self::RATING_TYPE, self::CHECKBOX_TYPE];
}