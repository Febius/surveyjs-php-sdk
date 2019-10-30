<?php

namespace SurveyJsPhpSdk\Parser;

use SurveyJsPhpSdk\Configuration\ElementConfiguration;
use SurveyJsPhpSdk\Exception\ElementTypeNotFoundException;
use SurveyJsPhpSdk\Exception\InvalidElementConfigurationException;
use SurveyJsPhpSdk\Exception\MissingElementConfigurationException;
use SurveyJsPhpSdk\Exception\PageDataNotFoundException;
use SurveyJsPhpSdk\Factory\ElementFactory;
use SurveyJsPhpSdk\Factory\PageFactory;
use SurveyJsPhpSdk\Model\TemplateModel;

class SurveyTemplateParser
{
    /**
     * @var ElementConfiguration[]
     */
    private $customConfigurations = [];

    /**
     * @param ElementConfiguration[] $customConfigurations
     * @throws InvalidElementConfigurationException
     */
    public function __construct($customConfigurations = array())
    {
        foreach ($customConfigurations as $customConfiguration) {
            if (($customConfiguration instanceof ElementConfiguration) === false) {
                throw new InvalidElementConfigurationException();
            }
            $this->customConfigurations[$customConfiguration->getType()] = $customConfiguration;
        }
    }

    /**
     * @param string $jsonTemplate
     *
     * @throws ElementTypeNotFoundException
     * @throws MissingElementConfigurationException
     * @throws PageDataNotFoundException
     *
     * @return TemplateModel
     */
    public function parse(string $jsonTemplate): TemplateModel
    {
        $template = json_decode($jsonTemplate);

        if (!isset($template->pages)) {
            throw new PageDataNotFoundException();
        }

        $surveyTemplateModel = new TemplateModel();

        foreach ($template->pages as $page) {
            $pageModel = (new SurveyPageParser())->parse($page);

            foreach ($page->elements as $element) {
                $config = $this->getConfigForElement($element);

                $pageModel->addElement(ElementFactory::create($element, $config));
            }

            $surveyTemplateModel->addPage($pageModel);
        }

        return $this->setDefaultProperties($surveyTemplateModel, $template);
    }

    /**
     * @param \stdClass $element
     *
     * @throws ElementTypeNotFoundException
     * @throws MissingElementConfigurationException
     *
     * @return ElementConfiguration|null
     */
    private function getConfigForElement(\stdClass $element): ?ElementConfiguration
    {
        if (!isset($element->type)) {
            throw new ElementTypeNotFoundException();
        }

        if (in_array($element->type, ElementFactory::KNOWN_TYPES)) {
            return null;
        }

        if (!isset($this->customConfigurations[$element->type])) {
            throw new MissingElementConfigurationException($element->type);
        }

        return $this->customConfigurations[$element->type];
    }

    /**
     * @param TemplateModel $model
     * @param \stdClass $data
     *
     * @return TemplateModel
     */
    private function setDefaultProperties(TemplateModel $model, \stdClass $data): TemplateModel
    {
        if (isset($data->showNavigationButtons)) {
            $model->setShowNavigationButtons($data->showNavigationButtons);
        }

        if (isset($data->showPageTitles)) {
            $model->setShowPageTitles($data->showPageTitles);
        }

        if (isset($data->showCompletedPage)) {
            $model->setShowCompletedPage($data->showCompletedPage);
        }

        if (isset($data->showQuestionNumbers)) {
            $model->setShowQuestionNumbers($data->showQuestionNumbers);
        }

        return $model;
    }
}
