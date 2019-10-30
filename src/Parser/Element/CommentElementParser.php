<?php


namespace SurveyJsPhpSdk\Parser\Element;

use SurveyJsPhpSdk\Model\Element\CommentElement;
use SurveyJsPhpSdk\Model\Element\ElementInterface;

class CommentElementParser extends DefaultSurveyElementParserAbstract
{
    public function parse(\stdClass $data): ElementInterface
    {
        $this->element = new CommentElement();

        return parent::parse($data);
    }
}
