<?php

namespace SurveyJsPhpSdk\Parser\Element;

use SurveyJsPhpSdk\Model\Element\ElementInterface;

abstract class ElementParserAbstract implements ElementParserInterface
{
    protected $element;

    protected function configure(\stdClass $data): void
    {
        if (isset($data->name)) {
            $this->element->setName($data->name);
        }
    }

    public function parse(\stdClass $data): ElementInterface
    {
        $this->configure($data);

        return $this->element;
    }
}
