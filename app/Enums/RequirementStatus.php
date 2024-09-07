<?php

declare(strict_types=1);

namespace App\Enums;

use App\Attributes\BackgroundColor;
use App\Attributes\Description;
use App\Concerns\AttributableEnum;
use App\Concerns\ValuableEnum;
use Filament\Support\Contracts\HasLabel;

enum RequirementStatus: string implements HasLabel
{
    use AttributableEnum, ValuableEnum;

    #[Description('')]
    #[BackgroundColor('')]
    case PENDING = 'Pending';

    #[Description('')]
    #[BackgroundColor('')]
    case APPROVED = 'Approved';

    #[Description('')]
    #[BackgroundColor('')]
    case IN_PROGRESS = 'In Progress';

    #[Description('')]
    #[BackgroundColor('')]
    case COMPLETED = 'Completed';
}
