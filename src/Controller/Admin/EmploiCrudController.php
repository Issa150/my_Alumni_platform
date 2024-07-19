<?php
namespace App\Controller\Admin;

use App\Entity\Emploi;
use App\Service\LogoService;
use App\Enum\EmploiTeleworking;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormBuilderInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use Symfony\Component\HttpFoundation\RequestStack;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use App\Form\DataTransformer\EnumToStringTransformer;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EmploiCrudController extends AbstractCrudController
{
    private $logoService;
    private $requestStack;
    private $uploadsDirectory;

    public function __construct(LogoService $logoService, RequestStack $requestStack, string $uploadsDirectory)
    {
        $this->logoService = $logoService;
        $this->requestStack = $requestStack;
        $this->uploadsDirectory = $uploadsDirectory;
    }

    public static function getEntityFqcn(): string
    {
        return Emploi::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $logoChoices = $this->logoService->getExistingLogos();

        $skills = [
            'PHP' => 'php',
            'JavaScript' => 'javascript',
            'Java' => 'java',
            'HTML' => 'html',
            'CSS' => 'css',
            'C' => 'c',
            'C++' => 'cpp',
            'Python' => 'python',
        ];

        $contracts = [
            'CDI' => 'cdi',
            'CDD' => 'cdd',
            'Temps plein' => 'tempsPlein',
            'Temps partiel' => 'tempsPartiel',
            'Apprentissage' => 'apprentissage',
            'Contrat pro' => 'contratPro',
            'Intérim' => 'interim',
            'Stage' => 'stage',
            'Alternance' => 'alternance',
            'Activité bénévole' => 'activiteBenevole',
            'Contrat de volontariat' => 'contratDeVolontariat',
            'Freelance/Indépendant' => 'freelanceIndependant',
        ];

        $logoChoicesWithLabels = [];
        foreach ($logoChoices as $logoName => $logoPath) {
            $logoChoicesWithLabels[sprintf('<img src="%s" style="max-height: 50px; margin-right: 10px;"/> %s', $logoPath, $logoName)] = $logoName;
        }

        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Intitulé du poste'),
            TextEditorField::new('description', 'Description'),
            TextField::new('link', 'Lien de l\'annonce'),
            TextField::new('entreprise', 'Entreprise'),
            TextField::new('zipcode', 'Code postal'),
            TextField::new('city', 'Ville'),
            ChoiceField::new('skills', 'Profil recherché / Compétences')
                ->setChoices($skills)
                ->allowMultipleChoices()
                ->renderExpanded(),
            TextField::new('field', 'Domaine d\'activité'),
            DateField::new('publication_date', 'Date de publication'),
            DateField::new('limit_offer', 'Expiration de l\'offre'),
            ChoiceField::new('teleworking', 'Télétravail')
            ->setChoices([
                'Présentiel' => EmploiTeleworking::OnSite,
                'Distanciel' => EmploiTeleworking::Remote,
                'Hybride' => EmploiTeleworking::Hybrid,
            ]),
            ChoiceField::new('contract', 'Type de contrat')
                ->setChoices($contracts)
                ->allowMultipleChoices()
                ->renderExpanded(),
            FormField::addPanel('Logo'),
            ChoiceField::new('logo', 'Logo')
                ->setChoices($logoChoicesWithLabels)
                ->renderExpanded()
                ->setTemplatePath('admin/field/logo_choice.html.twig'),
            TextField::new('newLogo', 'Téléchargement d\'un nouveau logo')->setFormType(FileType::class)->setFormTypeOptions([
                'mapped' => false,
                'required' => false,
            ]),
        ];
    }


    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $request = $this->requestStack->getCurrentRequest();
        /** @var UploadedFile $newLogoFile */
        $newLogoFile = $request->files->get('Emploi')['newLogo'];
        if ($newLogoFile) {
            $newFilename = uniqid().'.'.$newLogoFile->guessExtension();
            $newLogoFile->move($this->uploadsDirectory, $newFilename);
            $entityInstance->setLogo($newFilename);
        }

        parent::persistEntity($entityManager, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $request = $this->requestStack->getCurrentRequest();
        /** @var UploadedFile $newLogoFile */
        $newLogoFile = $request->files->get('Emploi')['newLogo'];
        if ($newLogoFile) {
            $newFilename = uniqid().'.'.$newLogoFile->guessExtension();
            $newLogoFile->move($this->uploadsDirectory, $newFilename);
            $entityInstance->setLogo($newFilename);
        }

        parent::updateEntity($entityManager, $entityInstance);
    }
}
