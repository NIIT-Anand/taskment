<?php

declare(strict_types=1);

namespace App\Enums;

use App\Attributes\BackgroundColor;
use App\Attributes\Description;
use App\Concerns\AttributableEnum;
use App\Concerns\ValuableEnum;
use Filament\Support\Contracts\HasLabel;

enum DefectSeverity: string implements HasLabel
{
    use AttributableEnum, ValuableEnum;

    #[Description('')]
    #[BackgroundColor('')]
    case LOW = 'Low';

    #[Description('')]
    #[BackgroundColor('')]
    case MEDIUM = 'Medium';

    #[Description('')]
    #[BackgroundColor('')]
    case HIGH = 'High';

    #[Description('')]
    #[BackgroundColor('')]
    case CRITICAL = 'Critical';
}
