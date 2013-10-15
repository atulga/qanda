<?php
namespace Qanda\HomeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nickname', null, array('label' => 'Нэр:'))
            ->add('description', null, array('label' => 'Тодорхойлолт:'))
        ->getForm();
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Qanda\HomeBundle\Entity\User',
            'cascade_validation' => true,
        ));
    }

    public function getName()
    {
        return 'user';
    }
}
