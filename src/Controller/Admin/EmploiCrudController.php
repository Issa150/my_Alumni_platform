<?php

namespace App\Controller\Admin;

use App\Entity\Emploi;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EmploiCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Emploi::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name','Intitulé du poste'),
            TextEditorField::new('description','Description'),
            TextField::new('entreprise','Entreprise'),
            TextField::new('zipcode','Code postal'),
            TextField::new('city','Ville'),
            TextEditorField::new('skills', 'Profil recherché / Compétences'),
            TextField::new('field', 'Domaine d\'activité'),
            DateTimeField::new('publication_date','Date de publication'),
            DateTimeField::new('limit_offer', 'Expiration de l\'offre'),
            BooleanField::new('teleworking','Télétravail'),
            TextField::new('contract','Type de contrat')
        ];
    }
    
}
