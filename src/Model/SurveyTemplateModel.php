<?php

namespace SurveyJsPhpSdk\Model;

class SurveyTemplateModel
{

    /** @var SurveyPageModel[] */
    private $pages;

    /** @var string */
    private $showNavigationButtons;

    /** @var boolean */
    private $showPageTitles;

    /** @var boolean */
    private $showCompletedPage;

    /** @var string */
    private $showQuestionNumbers;

    /**
     * @return SurveyPageModel[]
     */
    public function getPages(): array
    {
        return $this->pages;
    }

    /**
     * @param $pages
     *
     * @return SurveyTemplateModel
     */
    public function setPages($pages): self
    {
        $this->pages = $pages;

        return $this;
    }

    /**
     * @return string
     */
    public function getShowNavigationButtons(): string
    {
        return $this->showNavigationButtons;
    }

    /**
     * @param $showNavigationButtons
     *
     * @return SurveyTemplateModel
     */
    public function setShowNavigationButtons($showNavigationButtons): self
    {
        $this->showNavigationButtons = $showNavigationButtons;

        return $this;
    }

    /**
     * @return bool
     */
    public function isShowPageTitles(): bool
    {
        return $this->showPageTitles;
    }

    /**
     * @param bool $showPageTitles
     */
    public function setShowPageTitles($showPageTitles): self
    {
        $this->showPageTitles = $showPageTitles;

        return $this;
    }

    /**
     * @return bool
     */
    public function isShowCompletedPage(): bool
    {
        return $this->showCompletedPage;
    }

    /**
     * @param $showCompletedPage
     *
     * @return SurveyTemplateModel
     */
    public function setShowCompletedPage($showCompletedPage): self
    {
        $this->showCompletedPage = $showCompletedPage;

        return $this;
    }

    /**
     * @return string
     */
    public function getShowQuestionNumbers(): string
    {
        return $this->showQuestionNumbers;
    }

    /**
     * @param $showQuestionNumbers
     *
     * @return SurveyTemplateModel
     */
    public function setShowQuestionNumbers($showQuestionNumbers): self
    {
        $this->showQuestionNumbers = $showQuestionNumbers;

        return $this;
    }
}