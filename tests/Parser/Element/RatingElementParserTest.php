<?php


namespace SurveyJsPhpSdk\Tests\Parser\Element;

use PHPUnit\Framework\TestCase;
use SurveyJsPhpSdk\Factory\ElementFactory;
use SurveyJsPhpSdk\Model\ChoiceModel;
use SurveyJsPhpSdk\Model\Element\RatingElement;
use SurveyJsPhpSdk\Model\TextModel;
use SurveyJsPhpSdk\Model\TranslationModel;
use SurveyJsPhpSdk\Parser\Element\RatingElementParser;

class RatingElementParserTest extends TestCase
{

    /**
     * @var array
     */
    private $elements = [];
    /**
     * @var RatingElementParser
     */
    private $sut;

    protected function setUp()
    {
        $choice = (object)[
            'text'  => '6',
            'value' => '6'
        ];

        $choiceWithTranslation = (object)[
            'text' => (object)[
                'default' => 'choise 5',
                'en' => 'opt 5'
            ],
            'value' => '5'
        ];

        $this->elements[] = (object)[
            'type'         => ElementFactory::RATING_TYPE,
            'name'         => 'element_1',
            'title'        => 'Element 1',
            'isRequired'   => true,
            'enableIf'     => 'plausible conditions',
            'rateMax'      => 5
        ];

        $this->elements[] = (object)[
            'type'         => ElementFactory::RATING_TYPE,
            'name'         => 'element_2',
            'title'        => (object)[
                'default' => 'Element 2',
                'en' => 'title en'
            ],
            'isRequired'   => false,
            'enableIf'     => 'implausible conditions',
            'rateValues'   => [
                '1',
                '2',
                '3',
                '4',
                $choiceWithTranslation,
                $choice
            ],
            'rateMax'      => 6
        ];

        $this->sut = new RatingElementParser();
    }

    public function testParseSuccess()
    {
        foreach ($this->elements as $element) {
            $model = $this->sut->parse($element);
            $this->assertInstanceOf(RatingElement::class, $model);
            $this->assertInstanceOf(TextModel::class, $model->getTitle());
            $this->assertEquals($element->rateMax, count($model->getChoices()));
            $this->assertEquals($element->name, $model->getName());
            if (is_string($element->title)) {
                $this->assertEquals($element->title, $model->getTitle()->getDefaultValue());
            } else {
                $this->assertInstanceOf(TextModel::class, $model->getTitle());
                $this->assertInstanceOf(TranslationModel::class, $model->getTitle()->getTranslation('en'));
                $this->assertEquals($element->title->default, $model->getTitle()->getDefaultValue());
                $this->assertEquals($element->title->en, $model->getTitle()->getTranslation('en')->getTranslation());
            }
            $this->assertEquals($element->isRequired, $model->isRequired());
            $this->assertEquals($element->enableIf, $model->getEnableIf());

            $choicesModels = $model->getChoices();
            for ($i = 0; $i < $element->rateMax; $i++) {
                $this->assertInstanceOf(ChoiceModel::class, $choicesModels[$i]);
                $this->assertInstanceOf(TextModel::class, $choicesModels[$i]->getText());

                if (isset($element->rateValues) && is_object($element->rateValues[$i])) {
                    $this->assertEquals(
                        $element->rateValues[$i]->text->default ?? $element->rateValues[$i]->text,
                        $choicesModels[$i]->getText()->getDefaultValue()
                    );
                } else {
                    $this->assertEquals(
                        isset($element->rateValues[$i]) ? $element->rateValues[$i] : (string)($i + 1),
                        $choicesModels[$i]->getText()->getDefaultValue()
                    );
                }
            }
        }
    }
}
