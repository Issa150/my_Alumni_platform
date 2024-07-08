<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Form\{FormBuilderInterface, FormEvent, FormEvents};
use EasyCorp\Bundle\EasyAdminBundle\Field\{IdField, EmailField, TextField};
use EasyCorp\Bundle\EasyAdminBundle\Config\{Action, Actions, Crud, KeyValueStore};

class UserCrudController extends AbstractCrudController
{
    private MailerInterface $mailer;
    private UserPasswordHasherInterface $userPasswordHasher;

    public function __construct(
        MailerInterface $mailer,
        UserPasswordHasherInterface $userPasswordHasher
    ) {
        $this->mailer = $mailer;
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    // Fonction pour générer  un mot de passe aléatoire

    private function generateRandomPassword(int $length = 18): string
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()';
        $password = '';
        $max = strlen($characters) - 1;

        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[random_int(0, $max)];
        }

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
        $email = (new Email())
            ->from('your_email@example.com')
            ->to($user->getEmail())
            ->subject('Vos identifiants')
            ->html(sprintf('Bonjour,<br><br>Votre mot de passe est : <strong>%s</strong><br><br>Cordialement,<br>Votre application', $password));
    
        $this->mailer->send($email);
    }
}
