<?php


namespace SurveyJsPhpSdk\Model;


class SurveyResultModel
{
    /**
     * @var string 
     */
    private $question;

    /**
     * @var string 
     */
    private $answer;

    /**
     * @return string
     */
    public function getQuestion(): string
    {
        return $this->question;
    }

    /**
     * @param string $question
     *
     * @return SurveyResultModel
     */
    public function setQuestion(string $question): self
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
     * @param string $answer
     *
     * @return SurveyResultModel
     */
    public function setAnswer(string $answer): self
    {
        $this->answer = $answer;

        return $this;
    }
}