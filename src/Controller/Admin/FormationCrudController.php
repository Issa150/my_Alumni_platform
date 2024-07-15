<?php

namespace App\Controller\Admin;

use DateTime;
use App\Entity\Formation;
use App\Enum\FormationTeleworking;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FormationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Formation::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name','Nom'),
            TextEditorField::new('description','Description'),
            TextField::new('zipcode','Code postal'),
            TextField::new('city','Ville'),
            DateField::new('begin_at','Date de début'),
            DateField::new('end_at','Date de fin'),
            TextField::new('degree','Diplôme'),
            TextField::new('funding','Financement'),
            ChoiceField::new('teleworking', 'Télétravail')
                ->setChoices([
                    'Onsite' => FormationTeleworking::OnSite,
                    'Remote' => FormationTeleworking::Remote,
                    'Hybrid' => FormationTeleworking::Hybrid,
        ]),
        ];
    }
    
}
