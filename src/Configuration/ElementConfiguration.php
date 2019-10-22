<?php

namespace SurveyJsPhpSdk\Configuration;

use SurveyJsPhpSdk\Model\Element\ElementInterface;
use SurveyJsPhpSdk\Parser\Element\ElementParserAbstract;

class ElementConfiguration
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var ElementInterface
     */
    private $element;

    /**
     * @var ElementParserAbstract
     */
    private $parser;

    public function __construct(string $type, ElementInterface $element, ElementParserAbstract $parser)
    {
        $this->type = $type;
        $this->element = $element;
        $this->parser = $parser;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getElement(): ElementInterface
    {
        return $this->element;
    }

    public function getParser(): ElementParserAbstract
    {
        return $this->parser;
    }
}
