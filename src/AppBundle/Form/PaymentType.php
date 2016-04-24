<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Repository\PricingRepository;

class PaymentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pricing', EntityType::class, array(
                    'class' => 'AppBundle:Pricing',
                    'choice_label' => 'toStringLabel',
                    'query_builder' => function(PricingRepository $repo) use ($options) {
                        return $repo->getRegistrationPricingFromSchoolBuilder($options['school_id']);
                      }
                )
            )
            ->add('credit_card_number', TextType::class, array(
                    'mapped' => false
                )
            )
            ->add('credit_card_month', IntegerType::class, array(
                'mapped' => false
                )
            )
            ->add('credit_card_day', IntegerType::class, array(
                'mapped' => false
                )
            )
            ->add('credit_card_code', TextType::class, array(
                'mapped' => false
                )
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Payment',
            'intention'  => 'payment_type',
            'school_id'  => ""
        ));
    }
}
