<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 08/06/17
 * Time: 23:43
 */

namespace Miky\Bundle\CoreBundle\Form\Type;


use Miky\Bundle\CoreBundle\Form\DataTransformer\DateToStringTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TimeType extends AbstractType
{
    /**
     * @var string
     */
    protected $format;

    /**
     * @var string
     */
    protected $htmlFormat;

    /**
     * DateType constructor.
     */
    public function __construct()
    {
        $this->htmlFormat = 'H:i';
        $this->format = 'H:i';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer(new DateToStringTransformer(null, null, $this->format));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'label' => 'widget_label_unlink',
            'required' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['format'] = $this->format;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'miky_time_type';
    }

    public function getParent()
    {
        return TextType::class;
    }
}