<?php

namespace App\Form;

use App\Entity\Catalog\Product;
use App\Entity\Catalog\Category;
use App\Entity\Catalog\Specific;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('category',EntityType::class, [
            ->add('category', EntityType::class, [
                // looks for choices from this entity
                'class' => Category::class,
                // uses category name as the select option
                'choice_label' => 'name',
            ])
            ->add('name')
            ->add('excerpt')
            ->add('description')
            //->add('specifics', SpecificsType::class, [
            //        'data_class' => null,])
            ->add('quantity')
            ->add('brand')
            ->add('price')
            //->add('createdAt')  // automated by code
            //->add('editedAt')
            //->add('discount');
            //->add('specifics')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
