<?php

namespace App\Form;

use App\Entity\User;
use App\Enum\UserGender;
use App\Form\SocialLinksType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class UserProfileUpdaterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('firstname')
            ->add('lastname')
            ->add('phoneNumber')
            ->add('bio')
            ->add('cv')
            ->add('dateOfBirth', null, [
                'widget' => 'single_text',
            ])
            ->add('studyField')
            ->add('gender', ChoiceType::class, [
                'choices' => [
                    'Femme' => UserGender::Woman,
                    'Homme' => UserGender::Man,
                    'Non renseigné' => UserGender::Unavailable,
                ],
                'expanded' => true,
                'multiple' => false,
                'label' => 'Gender',
            ])
            // ->add('picture')
            ->add('picture', FileType::class, [
                'label' => "L'image profil (Image file)",

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
            ->add('city')
            ->add('country')
            ->add('certificateObtention')
            ->add('socialLinks', CollectionType::class, [
                'entry_type' => SocialLinksType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => false
            ])
            // ->add('save', SubmitType::class, [
            //     'label' => 'Sauvgarder'
            // ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
