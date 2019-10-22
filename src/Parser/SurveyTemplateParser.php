<?php

namespace SurveyJsPhpSdk\Parser;

use SurveyJsPhpSdk\Configuration\ElementConfiguration;
use SurveyJsPhpSdk\Exception\InvalidElementConfigurationException;
use SurveyJsPhpSdk\Exception\MissingElementConfigurationException;
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
     * @return TemplateModel
     * @throws MissingElementConfigurationException
     */
    public function parse(string $jsonTemplate): TemplateModel
    {
        $template = json_decode($jsonTemplate);
        $surveyTemplateModel = TemplateFactory::create($template);

        foreach ($template->pages as $page) {
            $pageModel = PageFactory::create($page);

            foreach ($page->elements as $element) {
                $pageModel->addElement(ElementFactory::create($element, $this->customConfigurations[$element->type]));
            }

            $surveyTemplateModel->addPage($pageModel);
        }

        return $surveyTemplateModel;
    }
}
