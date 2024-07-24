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

            ->add('email', null, [
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez entrer votre adresse e-mail']),
                ],
                'help' => 'Veuillez entrer votre adresse e-mail',
            ])
            ->add('firstname', null, [
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez entrer votre prénom']),
                ],
                'attr' => [
                    'placeholder' => 'Entrez votre prénom',
                ],
            ])
            ->add('lastname', null, [
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez entrer votre nom']),
                ],
                'attr' => [
                    'placeholder' => 'Entrez votre nom',
                ],
            ])
            ->add('phoneNumber', null, ['required' => false])
            ->add('bio', null, ['required' => false])

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
                'required' => false,
            ])
            ->add('studyField', null, [
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez entrer votre domaine d\'étude']),
                ],
                'attr' => [
                    'placeholder' => 'Entrez votre domaine d\'étude',
                ],
            ])
            ->add('gender', ChoiceType::class, [
                'choices' => [
                    'Femme' => UserGender::Woman,
                    'Homme' => UserGender::Man,
                    'Non renseigné' => UserGender::Unavailable,
                ],
                'expanded' => true,
                'multiple' => false,
                'label' => 'Genre',
              'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le genre est requis.',
                    ]),

                ],
            ])
            ->add('picture', FileType::class, [
                'label' => "Image profil (Image file)",
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '3M',
                        'mimeTypes' => ['image/jpeg', 'image/png'],
                        'mimeTypesMessage' => 'Please upload a valid image file (JPEG, PNG, GIF)',

                    ])
                ],
            ])
            ->add('cover', FileType::class, [
                'label' => "Image de couverture (Image file)",
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '3M',
                        'mimeTypes' => ['image/jpeg', 'image/png'],
                        'mimeTypesMessage' => 'Please upload a valid image file (JPEG, PNG, GIF)',

                    ])
                ],
            ])
            ->add('city', null, ['required' => false])
            ->add('country', null, ['required' => false])
            ->add('certificateObtention', null, [
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez entrer l\'obtention du certificat']),
                ],
                'attr' => [
                    'placeholder' => 'Entrez l\'obtention du certificat',
                ],
            ])
            ->add('socialLinks', CollectionType::class, [
                'entry_type' => SocialLinksType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => false,
                'required' => false,
            ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
