<?php

namespace App\Enum;

enum EmploiTeleworking: string
{
    case OnSite = 'OnSite';
    case Remote = 'Remote';
    case Hybrid = 'Hybrid';
    
    public function getLabel(): string
    {
        return match ($this) {
            self::OnSite => 'Présentiel',
            self::Remote => 'Distanciel',
            self::Hybrid => 'Hybride',
        };
    }
}