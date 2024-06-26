<?php

namespace App\Enum;

enum UserGender: string
{
    case Woman = 'Woman';
    case Man = 'Man';
    case Unavailable = 'Unavailable';
    
    public function getLabel(): string
    {
        return match ($this) {
            self::Woman => 'Femme',
            self::Man => 'Homme',
            self::Unavailable => 'Non renseigné',
        };
    }
}