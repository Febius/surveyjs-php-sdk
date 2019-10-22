<?php

namespace SurveyJsPhpSdk\Model;

class ResultModel
{
    /**
     * @var string
     */
    private $question;

    /**
     * @var string
     */
    private $answer;

    public function getQuestion(): string
    {
        return $this->question;
    }

    public function setQuestion(string $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getAnswer(): string
    {
        return $this->answer;
    }

    public function setAnswer(string $answer): self
    {
        $this->answer = $answer;

        return $this;
    }
}
