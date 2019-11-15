<?php

namespace SurveyJsPhpSdk\Configuration;

use SurveyJsPhpSdk\Model\Element\ElementInterface;
use SurveyJsPhpSdk\Parser\Element\ElementParserAbstract;

interface ElementConfigurationInterface
{
    public function getType(): string;

    public function getElement(): ElementInterface;

    public function getParser(): ElementParserAbstract;
}
