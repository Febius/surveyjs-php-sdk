<?php

namespace SurveyJsPhpSdk\Model;

class SurveyTemplateModel
{

    /**
     * @var SurveyPageModel[] 
     */
    private $pages = [];

    /**
     * @var string 
     */
    private $showNavigationButtons;

    /**
     * @var boolean 
     */
    private $showPageTitles;

    /**
     * @var boolean 
     */
    private $showCompletedPage;

    /**
     * @var string 
     */
    private $showQuestionNumbers;

    /**
     * @return SurveyPageModel[]
     */
    public function getPages(): array
    {
        return $this->pages;
    }

    /**
     * @param SurveyPageModel $pageToAdd
     *
     * @return SurveyTemplateModel
     */
    public function addPage(SurveyPageModel $pageToAdd): self
    {
        foreach($this->pages as $page){
            if($page->getName() === $pageToAdd->getName()) {
                return $this;
            }
        }

        $this->pages[] = $pageToAdd;

        return $this;
    }

    /**
     * @param SurveyPageModel $pageToRemove
     *
     * @return SurveyTemplateModel
     */
    public function removePage(SurveyPageModel $pageToRemove): self
    {
        foreach($this->pages as $index => $page){
            if($page->getName() === $pageToRemove->getName()) {
                unset($this->pages[$index]);
                return $this;
            }
        }

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
     * @param string $showNavigationButtons
     *
     * @return SurveyTemplateModel
     */
    public function setShowNavigationButtons(string $showNavigationButtons): self
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
     *
     * @return SurveyTemplateModel
     */
    public function setShowPageTitles(bool $showPageTitles): self
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
     * @param bool $showCompletedPage
     *
     * @return SurveyTemplateModel
     */
    public function setShowCompletedPage(bool $showCompletedPage): self
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
     * @param string $showQuestionNumbers
     *
     * @return SurveyTemplateModel
     */
    public function setShowQuestionNumbers(string $showQuestionNumbers): self
    {
        $this->showQuestionNumbers = $showQuestionNumbers;

        return $this;
    }
}