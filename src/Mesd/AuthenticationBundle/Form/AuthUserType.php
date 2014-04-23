<?php

namespace Mesd\AuthenticationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AuthUserType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('password')
            ->add('salt')
            ->add('email')
            ->add('firstName')
            ->add('lastName')
            ->add('lastLogin')
            ->add('isActive')
            ->add('isLocked')
            ->add('roles')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mesd\AuthenticationBundle\Entity\AuthUser'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'app_authenticationbundle_authuser';
    }
}
