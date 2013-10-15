<?php
namespace Qanda\HomeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AnswerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('answer', null, array('label' => 'Хариулт:'));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Qanda\HomeBundle\Entity\Answer',
            'cascade_validation' => true,
        ));
    }

    public function getName()
    {
        return 'answer';
    }
}
