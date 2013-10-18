<?php
namespace Qanda\HomeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Qanda\HomeBundle\Validator\Constraints\UserCheck;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array(
                'label' => 'Нэр:',
                'constraints' => array(
                    new UserCheck(),
                ),
            ))
            ->add('password', 'repeated', array(
                'type' => 'password',
                'invalid_message' => 'Нууц үг тохирохгүй байна!',
                'options' => array('attr' => array('class' => 'password-field')),
                'required' => true,
                'first_options'  => array('label' => 'Нууц үг'),
                'second_options' => array('label' => 'Нууц үг давтах'),
            ));
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
