<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstname', TextType::class, array(
            'required' => true
        ));
        $builder->add('lastname', TextType::class, array(
            'required' => true
        ));
        $builder->add('manager', CheckboxType::class, array(
            'label'    => 'Je souhaite ouvrir un compte pour gèrer mon école de conduite',
            'required' => false,
            'mapped' => false,
        ));
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getName()
    {
        return 'app_user_registration';
    }
}
