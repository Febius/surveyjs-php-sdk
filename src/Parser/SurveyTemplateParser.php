<?php

namespace SurveyJsPhpSdk\Parser;

use SurveyJsPhpSdk\Configuration\ElementConfiguration;
use SurveyJsPhpSdk\Exception\ElementTypeNotFoundException;
use SurveyJsPhpSdk\Exception\InvalidElementConfigurationException;
use SurveyJsPhpSdk\Exception\MissingElementConfigurationException;
use SurveyJsPhpSdk\Exception\PageDataNotFoundException;
use SurveyJsPhpSdk\Factory\ElementFactory;
use SurveyJsPhpSdk\Factory\PageFactory;
use SurveyJsPhpSdk\Factory\TemplateFactory;
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
        $surveyTemplateModel = TemplateFactory::create($template);

        if (!isset($template->pages)) {
            throw new PageDataNotFoundException();
        }

        foreach ($template->pages as $page) {
            $pageModel = PageFactory::create($page);

            foreach ($page->elements as $element) {
                $config = $this->getConfigForElement($element);

                $pageModel->addElement(ElementFactory::create($element, $config));
            }

            $surveyTemplateModel->addPage($pageModel);
        }

        return $surveyTemplateModel;
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
}
