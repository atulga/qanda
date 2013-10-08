<?php
namespace Qanda\HelloBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', new CategoryType())
            ->add('name', null, array('label' => 'Product Name:'))
            ->add('price', null, array('label' => 'Product Price:'))
            ->add('description', null, array('label' => 'Product Description'))
            ->add('Save this product', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Qanda\HelloBundle\Entity\Product',
            'cascade_validation' => true,
        ));
    }

    public function getName()
    {
        return 'product';
    }
}
