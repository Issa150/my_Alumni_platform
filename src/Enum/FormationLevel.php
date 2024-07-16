<?php

namespace App\Enum;

enum FormationLevel: string
{
    case Level3 = 'Level3';
    case Level4 = 'Level4';
    case Level5 = 'Level5';
    case Level6 = 'Level6';
    case Level7 = 'Level7';
    case Level8 = 'Level8';
    
    public function getLabel(): string
    {
        return match ($this) {
            self::Level3 => 'CAP',
            self::Level4 => 'BAC',
            self::Level5 => 'BAC+2',
            self::Level6 => 'BAC+3/4',
            self::Level7 => 'BAC+5',
            self::Level8 => 'BAC+8',
        };
    }
}