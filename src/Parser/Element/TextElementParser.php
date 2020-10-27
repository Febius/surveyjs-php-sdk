<?php


namespace SurveyJsPhpSdk\Parser\Element;

use SurveyJsPhpSdk\Exception\InvalidTextElementTypeException;
use SurveyJsPhpSdk\Factory\ElementFactory;
use SurveyJsPhpSdk\Model\Element\TextElement;
use SurveyJsPhpSdk\Parser\TextParser;

class TextElementParser extends DefaultElementParserAbstract
{
    protected function setupElement(): void
    {
        $this->element = new TextElement();
    }

    protected function configure(\stdClass $data): void
    {
        parent::configure($data);

        if (isset($data->inputType) && !in_array($data->inputType, ElementFactory::TEXT_SUBTYPES)) {
            throw new InvalidTextElementTypeException($data->inputType);
        }

        $inputsWithLimits = array(
            ElementFactory::NUMBER_TYPE,
            ElementFactory::DATETIME_TYPE,
            ElementFactory::DATETIME_LOCAL_TYPE,
            ElementFactory::DATE_TYPE,
            ElementFactory::RANGE_TYPE,
            ElementFactory::MONTH_TYPE,
            ElementFactory::WEEK_TYPE,
            ElementFactory::TIME_TYPE
        );

        if (isset($data->placeholder)) {
            $textParser = new TextParser();
            $this->element->setPlaceholder($textParser->parse($data->placeholder));
        }

        if (isset($data->inputType)) {
            $this->element->setInputType($data->inputType);

            if (isset($data->step) && $data->inputType === ElementFactory::NUMBER_TYPE) {
                $this->element->setStep($data->step);
            }

            if (in_array($data->inputType, $inputsWithLimits)) {
                if (isset($data->min)) {
                    $this->element->setMin($data->min);
                }

                if (isset($data->max)) {
                    $this->element->setMax($data->max);
                }
            }
        }
    }
}
