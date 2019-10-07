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
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * @param SurveyPageModel[] $pages
     */
    public function setPages($pages)
    {
        $this->pages = $pages;
    }

    /**
     * @return string
     */
    public function getShowNavigationButtons()
    {
        return $this->showNavigationButtons;
    }

    /**
     * @param string $showNavigationButtons
     */
    public function setShowNavigationButtons($showNavigationButtons)
    {
        $this->showNavigationButtons = $showNavigationButtons;
    }

    /**
     * @return bool
     */
    public function isShowPageTitles()
    {
        return $this->showPageTitles;
    }

    /**
     * @param bool $showPageTitles
     */
    public function setShowPageTitles($showPageTitles)
    {
        $this->showPageTitles = $showPageTitles;
    }

    /**
     * @return bool
     */
    public function isShowCompletedPage()
    {
        return $this->showCompletedPage;
    }

    /**
     * @param bool $showCompletedPage
     */
    public function setShowCompletedPage($showCompletedPage)
    {
        $this->showCompletedPage = $showCompletedPage;
    }

    /**
     * @return string
     */
    public function getShowQuestionNumbers()
    {
        return $this->showQuestionNumbers;
    }

    /**
     * @param string $showQuestionNumbers
     */
    public function setShowQuestionNumbers($showQuestionNumbers)
    {
        $this->showQuestionNumbers = $showQuestionNumbers;
    }
}