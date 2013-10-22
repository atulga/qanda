<?php
namespace Qanda\HomeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormError;

use Qanda\HomeBundle\Validator\Constraints\UserCheck;

use Qanda\HomeBundle\Entity\User;
use Doctrine\ORM\EntityManager;

class LoginType extends AbstractType
{
    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $em = $this->em;
        $builder
            ->add('name', null, array('label' => 'Нэр:'))
            ->add('password', 'password', array('label' => 'Нууц үг:'))
            ->addEventListener(
                FormEvents::POST_BIND,
                function ($event) use ($em) {
                    $form = $event->getForm();
                    $data = $form->getData();
                    $p = $data->getPassword();
                    $u = $data->getName();
                    if ($p == '' && $u == ''){
                       return; 
                    }
                    $filter = array('name'=> $u);
                    $user = $em->getRepository('QandaHomeBundle:User')
                        ->findOneBy($filter);
<<<<<<< HEAD
                    if ($user && ($user->getPassword() == $p)){
                        $form->object = $user;
=======
                    if ($user && ($user->getPassword() != $p)){
                        $message = 'Хэрэглэгчийн нэр эсвэл нууц дугаар буруу байна!';
                        $form['name']->addError(new FormError($message));
>>>>>>> 03abb2dfc5be9424212293dc720b206092742b07
                    } else {
                        $form['name']->addError(new FormError('Хэрэглэгчийн нэр эсвэл нууц үг буруу байна!'));
                    }
                }
            );
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
