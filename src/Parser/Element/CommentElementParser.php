<?php


namespace SurveyJsPhpSdk\Parser\Element;

use SurveyJsPhpSdk\Model\Element\CommentElement;

class CommentElementParser extends DefaultElementParserAbstract
{
    protected function setupElement(): void
    {
        $this->element = new CommentElement();
    }
}
