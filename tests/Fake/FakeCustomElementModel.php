<?php


namespace SurveyJsPhpSdk\Tests\Fake;


use SurveyJsPhpSdk\Model\Element\ElementInterface;

class FakeCustomElementModel implements ElementInterface
{

    private $name = 'fake_name';

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): ElementInterface
    {
        $this->name = $name;

        return $this;
    }
}