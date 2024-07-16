<?php

namespace App\Controller\Admin;

use App\Entity\Emploi;
use App\Enum\EmploiContract;
use App\Enum\EmploiTeleworking;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
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
            // Ajoutez d'autres rôles selon vos besoins
        ];
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name','Intitulé du poste'),
            TextEditorField::new('description','Description'),
            TextField::new('link','Lien de l\'annonce'),
            TextField::new('entreprise','Entreprise'),
            TextField::new('zipcode','Code postal'),
            TextField::new('city','Ville'),
            TextEditorField::new('skills', 'Profil recherché / Compétences'),
            TextField::new('field', 'Domaine d\'activité'),
            DateField::new('publication_date','Date de publication'),
            DateField::new('limit_offer', 'Expiration de l\'offre'),
            ChoiceField::new('teleworking', 'Télétravail')
                ->setChoices([
                    'Présentiel' => EmploiTeleworking::OnSite,
                    'Distanciel' => EmploiTeleworking::Remote,
                    'Hybride' => EmploiTeleworking::Hybrid,
        ]),
        ChoiceField::new('contract', 'Type de contrat')
        ->setLabel('Type de contrat')
        ->setChoices($contracts)
        ->allowMultipleChoices()
        ->renderExpanded(),
        
        ];
    }
    
}
