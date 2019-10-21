<?php


namespace SurveyJsPhpSdk\Configuration;


class SingleCustomElementConfiguration
{
    /**
     * @var string 
     */
    private $type;

    /**
     * @var string 
     */
    private $model;

    /**
     * @var string 
     */
    private $parser;

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return SingleCustomElementConfiguration
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return $this->model;
    }

    /**
     * @param string $model
     *
     * @return SingleCustomElementConfiguration
     */
    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    /**
     * @return string
     */
    public function getParser(): string
    {
        return $this->parser;
    }

    /**
     * @param string $parser
     *
     * @return SingleCustomElementConfiguration
     */
    public function setParser(string $parser): self
    {
        $this->parser = $parser;

        return $this;
    }
}