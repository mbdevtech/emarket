<?php

namespace App\Form;

use App\Entity\Account\BillingAddress;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BillingAdrType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('address')
            ->add('city')
            ->add('state')
            ->add('country')
            ->add('postalCode')
            //->add('profile')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BillingAddress::class,
        ]);
    }
}
