<?php

namespace App\Controller\Admin;

use DateTime;
use App\Entity\Formation;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
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
            DateTimeField::new('begin_at','Date de début'),
            DateTimeField::new('end_at','Date de fin'),
            TextField::new('degree','Diplôme'),
            TextField::new('funding','Financement'),
            BooleanField::new('teleworking','Télétravail')
        ];
    }
    
}
