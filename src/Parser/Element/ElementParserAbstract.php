<?php

namespace SurveyJsPhpSdk\Parser\Element;

use SurveyJsPhpSdk\Exception\ElementNameNotFoundException;
use SurveyJsPhpSdk\Model\Element\ElementInterface;

abstract class ElementParserAbstract implements ElementParserInterface
{
    protected $element;

    protected function configure(\stdClass $data): void
    {
        if (!isset($data->name) || empty($data->name)) {
            throw new ElementNameNotFoundException($data->type);
        }

        $this->element->setName($data->name);
    }

    public function parse(\stdClass $data): ElementInterface
    {
        $this->configure($data);

        return $this->element;
    }
}
