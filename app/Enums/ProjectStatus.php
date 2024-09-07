<?php

declare(strict_types=1);

namespace App\Enums;

use App\Attributes\BackgroundColor;
use App\Attributes\Description;
use App\Concerns\AttributableEnum;
use App\Concerns\ValuableEnum;
use Filament\Support\Contracts\HasLabel;

enum ProjectStatus: string implements HasLabel
{
    use AttributableEnum, ValuableEnum;

    #[Description('')]
    #[BackgroundColor('')]
    case PLANNING = 'Planning';

    #[Description('')]
    #[BackgroundColor('')]
    case IN_PROGRESS = 'In Progress';

    #[Description('')]
    #[BackgroundColor('')]
    case TESTING = 'Testing';

    #[Description('')]
    #[BackgroundColor('')]
    case COMPLETED = 'Completed';
}
