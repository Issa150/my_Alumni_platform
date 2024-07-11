<?php

namespace App\Enum;

enum FormationTeleworking: string
{
    case OnSite = 'OnSite';
    case Remote = 'Remote';
    case Hybrid = 'Hybrid';
    
    public function getLabel(): string
    {
        return match ($this) {
            self::OnSite => 'Sur site',
            self::Remote => 'À distance',
            self::Hybrid => 'Hybride',
        };
    }
}