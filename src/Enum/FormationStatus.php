<?php

namespace App\Enum;

enum FormationStatus: string
{
    case Pending = 'Pending';
    case Validated = 'Validated';
    case Refused = 'Refused';

    
    public function getLabel(): string
    {
        return match ($this) {
            self::Pending => 'En attente',
            self::Validated => 'Validé',
            self::Refused => 'Refusé',
        };
    }
}