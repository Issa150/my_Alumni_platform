<?php
namespace App\Controller\Admin;

use App\Entity\Formation;
use App\Service\LogoService;
use App\Enum\FormationTeleworking;
use App\Enum\FormationLevel;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use EasyCorp\Bundle\EasyAdminBundle\Field\HtmlField;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;

class FormationCrudController extends AbstractCrudController
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
        return Formation::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $logoChoices = $this->logoService->getExistingLogos();

        $fundings = [
            'France Travail' => 'franceTravail',
            'OPCO' => 'opco',
            'AGEFIPH' => 'agefiph',
            'Entreprise' => 'entreprise',
            'CPF' => 'cpf',
            'Autre' => 'autre',
        ];

        $logoChoicesWithLabels = [];
        foreach ($logoChoices as $logoName => $logoPath) {
            $logoChoicesWithLabels[sprintf('<img src="%s" style="max-height: 50px; margin-right: 10px;"/> %s', $logoPath, $logoName)] = $logoName;
        }


        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Nom'),
            TextEditorField::new('description', 'Description'),
            TextField::new('link', 'Lien de la formation'),
            TextField::new('zipcode', 'Code postal'),
            TextField::new('city', 'Ville'),
            DateField::new('begin_at', 'Date de début'),
            DateField::new('end_at', 'Date de fin'),
            TextField::new('degree', 'Diplôme'),
            ChoiceField::new('teleworking', 'Télétravail')
                ->setChoices([
                    'Présentiel' => FormationTeleworking::OnSite,
                    'Distanciel' => FormationTeleworking::Remote,
                    'Hybride' => FormationTeleworking::Hybrid,
                ]),
            ChoiceField::new('required_level', 'Niveau requis')
                ->setChoices([
                    'CAP' => FormationLevel::Level3,
                    'BAC' => FormationLevel::Level4,
                    'BAC+2' => FormationLevel::Level5,
                    'BAC+3/4' => FormationLevel::Level6,
                    'BAC+5' => FormationLevel::Level7,
                    'BAC+8' => FormationLevel::Level8,
                ]),
            ChoiceField::new('funding', 'Type de financement')
                ->setLabel('Type de financement')
                ->setChoices($fundings)
                ->allowMultipleChoices()
                ->renderExpanded(),
                FormField::addPanel('Logo'),
                ChoiceField::new('logo', 'Logo')
                    ->setChoices($logoChoicesWithLabels)
                    ->renderExpanded()
                    ->setTemplatePath('admin/field/logo_choice.html.twig'),
                TextField::new('newLogo', 'Upload New Logo')->setFormType(FileType::class)->setFormTypeOptions([
                    'mapped' => false,
                    'required' => false,
                ]),
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $request = $this->requestStack->getCurrentRequest();
        /** @var UploadedFile $newLogoFile */
        $newLogoFile = $request->files->get('Formation')['newLogo'];
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
        $newLogoFile = $request->files->get('Formation')['newLogo'];
        if ($newLogoFile) {
            $newFilename = uniqid().'.'.$newLogoFile->guessExtension();
            $newLogoFile->move($this->uploadsDirectory, $newFilename);
            $entityInstance->setLogo($newFilename);
        }

        parent::updateEntity($entityManager, $entityInstance);
    }
}
