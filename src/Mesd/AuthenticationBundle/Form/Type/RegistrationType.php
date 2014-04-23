<?php
// src Mesd/AuthenticationBundle/Form/Type/Registration.php
namespace Mesd\AuthenticationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', 'text');
        $builder->add('email', 'email');
        $builder->add('password', 'repeated', array(
            'type'           => 'password',
            'first_options'  => array('label' => 'Password'),
            'second_options' => array('label' => 'Confirm'),
        ));
        $builder->add('save', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mesd\AuthenticationBundle\Entity\AuthUser'
        ));
    }

    public function getName()
    {
        return 'registration';
    }
}