<?php

namespace SurveyJsPhpSdk\Model;

class ResultModel
{
    /**
     * @var string
     */
    private $question;

    /**
     * @var string|array
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

    /**
     * @return string|array
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * @param string|array $answer
     * @return $this
     */
    public function setAnswer($answer): self
    {
        $this->answer = $answer;

        return $this;
    }

    public function isMultipleChoiceAnswer(): bool
    {
        return is_array($this->answer);
    }
}
