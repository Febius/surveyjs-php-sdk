<?php

namespace SurveyJsPhpSdk\Model\Element;

interface ElementInterface
{
    public function getName(): string;

    public function setName(string $name): ElementInterface;

    public function getTitle(): string;

    public function setTitle(string $title): ElementInterface;

    public function isRequired(): bool;

    public function setRequired(bool $required): ElementInterface;

    public function getEnableIf(): string;

    public function setEnableIf(string $enableIf): ElementInterface;
}
