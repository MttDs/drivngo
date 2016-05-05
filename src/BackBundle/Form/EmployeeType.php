<?php

namespace BackBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class EmployeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstname', TextType::class, array(
            'required' => true
        ));
        $builder->add('lastname', TextType::class, array(
            'required' => true
        ));
        $builder->add('role', ChoiceType::class, array(
            'choices'   => array(
                'ROLE_SECRETARY'   => 'Secrétaire',
                'ROLE_INSTRUCTOR'      => 'Moniteur',
            ),
            'multiple'  => false
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\User',
            'intention'   => 'employee_type'
        ));
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getName()
    {
        return 'app_employee';
    }
}
