<?php

namespace App\Form;

use App\Entity\Account\ShippingAddress;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ShippingAdrType extends AbstractType
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
            'data_class' => ShippingAddress::class,
        ]);
    }
}
