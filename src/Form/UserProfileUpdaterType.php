<?php
namespace App\Form;

use App\Entity\User;
use App\Enum\UserGender;
use App\Form\SocialLinksType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class UserProfileUpdaterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('firstname', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le prénom est requis.',
                    ]),
                ],
            ])
            ->add('lastname', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le nom est requis.',
                    ]),
                ],
            ])
            ->add('phoneNumber')
            ->add('bio')
            ->add('cv', FileType::class, [
                'label' => "CV (PDF file)",
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '3M',
                        'mimeTypes' => [
                            'application/pdf',
                        ],
                        'mimeTypesMessage' => 'Veuillez télécharger un fichier PDF valide.',
                    ])
                ],
            ])
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
                'label' => 'Genre',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le genre est requis.',
                    ]),
                ],
            ])
            ->add('picture', FileType::class, [
                'label' => "L'image profil (Image file)",
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '3M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Veuillez télécharger un fichier image valide (JPEG, PNG, GIF).',
                    ])
                ],
            ])
            ->add('cover', FileType::class, [
                'label' => "L'image de couverture (Image file)",
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '3M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Veuillez télécharger un fichier image valide (JPEG, PNG, GIF).',
                    ])
                ],
            ])
            ->add('city')
            ->add('country')
            ->add('certificateObtention')
            ->add('socialLinks', CollectionType::class, [
                'entry_type' => SocialLinksType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => false,
            ]);
            // Uncomment below if you want to add a save button
            // ->add('save', SubmitType::class, [
            //     'label' => 'Sauvgarder'
            // ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
