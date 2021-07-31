<?php

namespace App\Form;

use App\Entity\Account\Profile;
use App\Entity\Account\BillingAddress;
use App\Entity\Account\ShippingAddress;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('userid')   // only a test
            ->add('fullName')
            ->add('displayName')
            ->add('email',EmailType::class)
            ->add('phoneNumber')
            ->add('picture', FileType::class, [
                'label' => 'Picture (img file)',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '512k', // img max siae
                        'mimeTypes' => [
                             'image/png',
                             'image/jpg',
                             'image/jpeg',
                             'image/x-png',
                        ],
                       'mimeTypesMessage' => 'Please upload a valid img document',
                    ])
                ],
            ])
           ->add('cover', FileType::class, [
            'label' => 'Cover (img file)',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '512k', // img max siae
                        'mimeTypes' => [
                             'image/png',
                             'image/jpg',
                             'image/jpeg',
                             'image/x-png',
                        ],
                       'mimeTypesMessage' => 'Please upload a valid img document',
                    ])
                ],
            ])
            ->add('description')
           // this field is related to a table
            ->add('billingAddress', BillingAdrType::class, [
                    'data_class' => BillingAddress::class,])
            // this is related too
            ->add('shippingAddress', ShippingAdrType::class, [
                  'data_class' => ShippingAddress::class,])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Profile::class,
        ]);
    }
}
