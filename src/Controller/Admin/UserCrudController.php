<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Twig\Environment;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Form\{FormBuilderInterface, FormEvent, FormEvents};
use EasyCorp\Bundle\EasyAdminBundle\Field\{IdField, EmailField, TextField};
use EasyCorp\Bundle\EasyAdminBundle\Config\{Action, Actions, Crud, KeyValueStore};

class UserCrudController extends AbstractCrudController
{
    private UserPasswordHasherInterface $userPasswordHasher;
    private MailerInterface $mailer;
    private UrlGeneratorInterface $urlGenerator;
    private Environment $twig;

    public function __construct(
        UserPasswordHasherInterface $userPasswordHasher,
        MailerInterface $mailer,
        UrlGeneratorInterface $urlGenerator,
        Environment $twig
    ) {
        $this->userPasswordHasher = $userPasswordHasher;
        $this->mailer = $mailer;
        $this->urlGenerator = $urlGenerator;
        $this->twig = $twig;
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    // Fonction pour générer  un mot de passe aléatoire

    function generateRandomPassword(int $length = 18): string {
    
        $lowercase = 'abcdefghijklmnopqrstuvwxyz';
        $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numbers = '0123456789';
        $specialCharacters = '!@#$%^&*()-_+=<>?';
    
        // le mot de passe doit comporter au moins 1 minuscule, 1 majuscule, 1 chiffre et 1 caractère spécial
        $password = '';
        $password .= $lowercase[random_int(0, strlen($lowercase) - 1)];
        $password .= $uppercase[random_int(0, strlen($uppercase) - 1)];
        $password .= $numbers[random_int(0, strlen($numbers) - 1)];
        $password .= $specialCharacters[random_int(0, strlen($specialCharacters) - 1)];
    
        $allCharacters = $lowercase . $uppercase . $numbers . $specialCharacters;
        for ($i = 4; $i < $length; $i++) {
            $password .= $allCharacters[random_int(0, strlen($allCharacters) - 1)];
        }
    
        // Crée un mot de passe aléatoire
        $password = str_shuffle($password);
    
        return $password;
    }

    // pré-remplis le formulaire avec le mot de passe aléatoire

    public function createEntity(string $entityFqcn)
    {
        $user = new User();
        $randomPassword = $this->generateRandomPassword();
        $user->setPassword($randomPassword);

        return $user;
    }



    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_EDIT, Action::INDEX)
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->add(Crud::PAGE_EDIT, Action::DETAIL);
    }

    // Configure le formulaire easyAdmin

    public function configureFields(string $pageName): iterable
    {
        $fields = [
            IdField::new('id')->hideOnForm(),
            EmailField::new('email'),
            ArrayField::new('roles', 'Role'),
            TextField::new('password','Mot de passe')
        ];

        return $fields;
    }



    public function createNewFormBuilder(EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context): FormBuilderInterface
    {
        // Créer le FormBuilder pour le formulaire de création
        $formBuilder = parent::createNewFormBuilder($entityDto, $formOptions, $context);

        // Ajouter un événement pour hasher le mot de passe après la soumission du formulaire
        $this->addPasswordEventListener($formBuilder);

        return $formBuilder;
    }

// Création d'un ecouteur d'événement pour hacher le mot de passe et envoyer le mail à l'utilisateur après la soumission du formulaire

    private function addPasswordEventListener(FormBuilderInterface $formBuilder): FormBuilderInterface
    {
        return $formBuilder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
            $user = $event->getData();
            $form = $event->getForm();
    
            // Vérifier si le formulaire est valide et que l'utilisateur a un e-mail défini
            if ($form->isValid() && $user->getEmail()) {
                // Récupérer le mot de passe en clair saisi par l'utilisateur depuis le formulaire
                $plainPassword = $form->get('password')->getData();
    
                // Hasher le mot de passe
                $hashedPassword = $this->userPasswordHasher->hashPassword($user, $plainPassword);
                $user->setPassword($hashedPassword);
    
                // Envoyer l'e-mail avec les identifiants à l'utilisateur
                $this->sendCredentialsEmail($user, $plainPassword);

                $this->addFlash(type:'info', message: "Les identifiants de connexion ont été envoyés à l'utilisateur");
            }
        });
    }

    private function hashPassword()
    {
        return function ($event) {
            $form = $event->getForm();
            if (!$form->isValid()) {
                return;
            }
            $password = $form->get('password')->getData();
            if ($password === null) {
                return;
            }

            $hash = $this->userPasswordHasher->hashPassword($form->getData(), $password);
            $form->getData()->setPassword($hash);
        };
    }


    // Configuration de l'email à envoyer 

    private function sendCredentialsEmail(User $user, string $password): void
    {
        $loginUrl = $this->generateUrl('app_login', [], UrlGeneratorInterface::ABSOLUTE_URL);

        $email = (new TemplatedEmail())
            ->from('your_email@example.com')
            ->to($user->getEmail())
            ->subject('Vos identifiants')
            ->htmlTemplate('emails/credentials.html.twig')
            ->context([
                'userEmail' => $user->getEmail(),
                'password' => $password,
                'loginUrl' => $loginUrl,
            ]);
    
        $this->mailer->send($email);
    }
}
