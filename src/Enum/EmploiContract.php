<?php

namespace App\Enum;

enum EmploiContract: string
{
    case TempsPlein = 'TempsPlein';
    case TempsPartiel = 'TempsPartiel';
    case Contrat = 'Contrat';
    case TravailTemporaire = 'TravailTemporaire';
    case Benevolat = 'Benevolat';
    case StageAlternance = 'StageAlternance';
    case Autre = 'Autre';
    
    public function getLabel(): string
    {
        return match ($this) {
            self::TempsPlein => 'Temps plein',
            self::TempsPartiel => 'Temps partiel',
            self::Contrat => 'Contrat',
            self::TravailTemporaire => 'Travail temporaire',
            self::Benevolat => 'Bénévolat',
            self::StageAlternance => 'Stage / Alternance',
            self::Autre => 'Autre',
        };
    }
}