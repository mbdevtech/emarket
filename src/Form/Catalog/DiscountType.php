<?php

namespace App\Form\Catalog;

use App\Entity\Catalog\Discount;
use App\Entity\Catalog\Product;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DiscountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type')
            ->add('name')
            ->add('rate')
            //->add('startDate')

            ->add('startDate', DateType::class, [
                'widget' => 'single_text',

                // prevents rendering it as type="date", to avoid HTML5 date pickers
                //'html5' => false,

                // adds a class that can be selected in JavaScript
                //'attr' => ['class' => 'js-datepicker'],
            ])
            //->add('expiryDate')
            ->add('expiryDate', DateType::class, [
                'widget' => 'single_text',

                // prevents rendering it as type="date", to avoid HTML5 date pickers
                //'html5' => false,

                // adds a class that can be selected in JavaScript
                //'attr' => ['class' => 'js-datepicker'],
            ])
           // ->add('product', EntityType::class)
            ->add('product', EntityType::class, [
                // looks for choices from this entity
                'class' => Product::class,
            
                // uses the User.username property as the visible option string
                'choice_label' => 'name',
            
                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Discount::class,
        ]);
    }
}
