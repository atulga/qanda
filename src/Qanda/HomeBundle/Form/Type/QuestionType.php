<?php
namespace Qanda\HomeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array('label' => 'Гарчиг:'))
            ->add('question', null, array('label' => 'Асуулт:'));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Qanda\HomeBundle\Entity\Question',
            'cascade_validation' => true,
        ));
    }

    public function getName()
    {
        return 'question';
    }
}
