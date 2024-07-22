<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UserProfileUpdaterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('picture', FileType::class, [
                "label" => "Noouvell image:",

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the picture file
                // every time you edit the entity details
                'required' => false,

                // unmapped fields can't define their validation using attributes
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '5M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image file (JPEG, PNG, GIF)',
                    ])
                ],
            ])
            ->add('cover')
            // ->add('cover', FileType::class, [
            //     "label" => "L'image cover:",

            //     // unmapped means that this field is not associated to any entity property
            //     'mapped' => false,

            //     // make it optional so you don't have to re-upload the picture file
            //     // every time you edit the entity details
            //     'required' => false,

            //     // unmapped fields can't define their validation using attributes
            //     // in the associated entity, so you can use the PHP constraint classes
            //     'constraints' => [
            //         new File([
            //             'maxSize' => '5M',
            //             'mimeTypes' => [
            //                 'image/jpeg',
            //                 'image/png',
            //             ],
            //             'mimeTypesMessage' => 'Please upload a valid image file (JPEG, PNG)',
            //         ])
            //     ],
            // ])
            // ->add('roles')
            // ->add('password')
            ->add('firstname')
            ->add('lastname')
            ->add('email')
            ->add('phoneNumber')
            ->add('bio')
            ->add('cv')
            // ->add('cv', FileType::class, [
            //     'label' => 'CV:',
            //     'apped' => false,
            //     'equired' => false,
            //     'constraints' => [
            //         new File([
            //             'axSize' => '5M',
            //             'imeTypes' => [
            //                 'application/pdf',
            //             ],
            //             'imeTypesMessage' => 'Please upload a valid PDF file',
            //         ])
            //     ],
            // ])
            
            ->add('dateOfBirth', null, [
                'widget' => 'single_text',
            ])
            ->add('studyField')
            ->add('gender')
            ->add('certificateYearObtention', null, [
                'widget' => 'single_text',
            ])
            // ->add('lastConnectedAt', null, [
            //     'widget' => 'single_text',
            // ])
            ->add('city')
            ->add('country');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
