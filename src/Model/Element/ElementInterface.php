<?php

namespace SurveyJsPhpSdk\Model\Element;

interface ElementInterface
{
    public function getName(): string;

    public function setName(string $name): ElementInterface;
}
