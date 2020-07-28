<?php


namespace SurveyJsPhpSdk\Tests\Parser\Element;

use PHPUnit\Framework\TestCase;
use SurveyJsPhpSdk\Factory\ElementFactory;
use SurveyJsPhpSdk\Model\ChoiceModel;
use SurveyJsPhpSdk\Model\Element\CheckboxElement;
use SurveyJsPhpSdk\Model\TextModel;
use SurveyJsPhpSdk\Model\TranslationModel;
use SurveyJsPhpSdk\Parser\Element\CheckboxElementParser;

class CheckboxElementParserTest extends TestCase
{
    /**
     * @var array
     */
    private $elements = [];
    /**
     * @var CheckboxElementParser
     */
    private $sut;

    protected function setUp()
    {
        $choice1 = (object)[
            'text'  => 'choice 1',
            'value' => '1'
        ];

        $choice2 = (object)[
            'text'  => (object)[
                'default' => 'choice 2',
                'it' => 'opzione 2'
            ],
            'value' => '2'
        ];

        $this->elements[] = (object)[
            'type'         => ElementFactory::CHECKBOX_TYPE,
            'name'         => 'element_2',
            'title'        => 'Element 2',
            'isRequired'   => false,
            'choicesOrder' => 'desc',
            'enableIf'     => 'implausible conditions',
            'choices'      => [$choice1, 'item2', 'item3'],
            'otherText'    => 'other (describe)'
        ];

        $this->elements[] = (object)[
            'type'         => ElementFactory::CHECKBOX_TYPE,
            'name'         => 'element_2',
            'title'        => (object)[
                'default' => 'title',
                'en' => 'element_2',
            ],
            'isRequired'   => false,
            'choicesOrder' => 'desc',
            'enableIf'     => 'implausible conditions',
            'choices'      => [$choice1, $choice2, 'item3'],
            'otherText'    => (object)[
                'default' => 'other text default',
                'es' => 'text es'
            ],
        ];

        $this->elements[] = (object)[
            'type'         => ElementFactory::CHECKBOX_TYPE,
            'name'         => 'element_3',
            'title'        => 'Element 3',
            'isRequired'   => false,
            'choicesOrder' => 'desc',
            'enableIf'     => 'implausible conditions',
            'choices'      => ['item1']
        ];

        $this->sut = new CheckboxElementParser();
    }

    public function testParseSuccess()
    {
        $element = $this->elements[0];
        $model = $this->sut->parse($element);
        $choices = $model->getChoices();

        $this->assertInstanceOf(CheckboxElement::class, $model);
        $this->assertEquals($element->name, $model->getName());
        $this->assertInstanceOf(TextModel::class, $model->getTitle());
        $this->assertEquals($element->title, $model->getTitle()->getDefaultValue());
        $this->assertEquals($element->isRequired, $model->isRequired());
        $this->assertEquals($element->enableIf, $model->getEnableIf());
        $this->assertTrue($model->hasOther());

        foreach ($choices as $choice) {
            $this->assertInstanceOf(ChoiceModel::class, $choice);
        }

        $this->assertEquals(1+count($element->choices), count($choices));
        $this->assertInstanceOf(TextModel::class, end($choices)->getText());
        $this->assertEquals('other', end($choices)->getText()->getDefaultValue());
    }

    public function testParseSuccessWithTranslation()
    {
        $element = $this->elements[1];
        $model = $this->sut->parse($element);
        $choices = $model->getChoices();

        $this->assertInstanceOf(CheckboxElement::class, $model);
        $this->assertEquals($element->name, $model->getName());
        $this->assertInstanceOf(TextModel::class, $model->getTitle());
        $this->assertEquals($element->title->default, $model->getTitle()->getDefaultValue());
        $this->assertInstanceOf(TranslationModel::class, $model->getTitle()->getTranslation('en'));
        $this->assertEquals($element->title->en, $model->getTitle()->getTranslation('en')->getTranslation());
        $this->assertEquals($element->isRequired, $model->isRequired());
        $this->assertEquals($element->enableIf, $model->getEnableIf());
        $this->assertTrue($model->hasOther());

        foreach ($choices as $choice) {
            $this->assertInstanceOf(ChoiceModel::class, $choice);
        }

        $this->assertEquals(1+count($element->choices), count($choices));
        $this->assertInstanceOf(TextModel::class, end($choices)->getText());
        $this->assertEquals($element->otherText->default, end($choices)->getText()->getDefaultValue());
    }

    public function testParseSuccessWithoutOtherText()
    {
        $element = $this->elements[2];
        $model = $this->sut->parse($element);
        $choices = $model->getChoices();

        $this->assertInstanceOf(CheckboxElement::class, $model);
        $this->assertEquals($element->name, $model->getName());
        $this->assertEquals($element->title, $model->getTitle()->getDefaultValue());
        $this->assertEquals($element->isRequired, $model->isRequired());
        $this->assertEquals($element->enableIf, $model->getEnableIf());
        $this->assertFalse($model->hasOther());

        foreach ($choices as $choice) {
            $this->assertInstanceOf(ChoiceModel::class, $choice);
            $this->assertInstanceOf(TextModel::class, $choice->getText());
        }

        $this->assertEquals(count($element->choices), count($choices));
        $this->assertNotEquals('other', end($choices)->getText()->getDefaultValue());
    }
}
