<?php

declare(strict_types=1);

namespace App\Enums;

use App\Attributes\BackgroundColor;
use App\Attributes\Description;
use App\Concerns\AttributableEnum;
use App\Concerns\ValuableEnum;
use Filament\Support\Contracts\HasLabel;

enum DefectStatus: string implements HasLabel
{
    use AttributableEnum, ValuableEnum;

    #[Description('')]
    #[BackgroundColor('')]
    case OPEN = 'Open';

    #[Description('')]
    #[BackgroundColor('')]
    case RE_OPENED = 'Re-Opened';

    #[Description('')]
    #[BackgroundColor('')]
    case IN_PROGRESS = 'In Progress';

    #[Description('')]
    #[BackgroundColor('')]
    case FIXED = 'Fixed';

    #[Description('')]
    #[BackgroundColor('')]
    case COMPLETED = 'Completed';
}
