<?php

namespace App\Enum;

enum EmploiStatus: string
{
    case PENDING = 'pending';
    case VALIDATED = 'validated';
    case REFUSED = 'refused';

    
    public function getLabel(): string
    {
        return match ($this) {
            self::PENDING => 'En attente',
            self::VALIDATED => 'Validé',
            self::REFUSED => 'Refusé',
        };
    }
}