<?php

namespace SurveyJsPhpSdk\Model;

class TemplateModel
{
    /**
     * @var PageModel[]
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
     * @return PageModel[]
     */
    public function getPages(): array
    {
        return $this->pages;
    }

    public function addPage(PageModel $pageToAdd): self
    {
        foreach ($this->pages as $page) {
            if ($page->getName() === $pageToAdd->getName()) {
                return $this;
            }
        }

        $this->pages[] = $pageToAdd;

        return $this;
    }

//    public function removePage(PageModel $pageToRemove): self
//    {
//        foreach($this->pages as $index => $page){
//            if($page->getName() === $pageToRemove->getName()) {
//                unset($this->pages[$index]);
//                return $this;
//            }
//        }
//
//        return $this;
//    }

    public function getShowNavigationButtons(): string
    {
        return $this->showNavigationButtons;
    }

    public function setShowNavigationButtons(string $showNavigationButtons): self
    {
        $this->showNavigationButtons = $showNavigationButtons;

        return $this;
    }

    public function isShowPageTitles(): bool
    {
        return $this->showPageTitles;
    }

    public function setShowPageTitles(bool $showPageTitles): self
    {
        $this->showPageTitles = $showPageTitles;

        return $this;
    }

    public function isShowCompletedPage(): bool
    {
        return $this->showCompletedPage;
    }

    public function setShowCompletedPage(bool $showCompletedPage): self
    {
        $this->showCompletedPage = $showCompletedPage;

        return $this;
    }

    public function getShowQuestionNumbers(): string
    {
        return $this->showQuestionNumbers;
    }

    public function setShowQuestionNumbers(string $showQuestionNumbers): self
    {
        $this->showQuestionNumbers = $showQuestionNumbers;

        return $this;
    }
}
