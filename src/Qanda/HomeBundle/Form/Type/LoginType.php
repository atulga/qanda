<?php
namespace Qanda\HomeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Qanda\HomeBundle\Validator\Constraints\UserCheck;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormError;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array(
                'label' => 'Нэр:',
               // 'constraints' => array(
               //     new usercheck(),
               // ),
            ))
            ->addEventListener(FormEvents::POST_BIND, function ($event) use ($builder) {
                $form = $event->getForm();
                $data = $form->getData();
                $p = $data->getPassword();
                $u = $data->getName();


                $form['name']->addError(new FormError('Error: '. $p.' - '.$u));

            })
            ->add('password', 'password', array(
                'label' => 'Нууц үг:',
               // 'constraints' => array(
               //     new usercheck(),
               // ),
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
