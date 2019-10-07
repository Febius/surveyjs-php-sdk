<?php


namespace SurveyJsPhpSdk\Model;


class SurveyResultModel
{
    /** @var string */
    private $question;

    /** @var string */
    private $answer;

    /**
     * @return string
     */
    public function getQuestion(): string
    {
        return $this->question;
    }

    /**
     * @param $question
     *
     * @return SurveyResultModel
     */
    public function setQuestion($question): self
    {
        $this->question = $question;

        return $this;
    }

    /**
     * @return string
     */
    public function getAnswer(): string
    {
        return $this->answer;
    }

    /**
     * @param $answer
     *
     * @return SurveyResultModel
     */
    public function setAnswer($answer): self
    {
        $this->answer = $answer;

        return $this;
    }
}