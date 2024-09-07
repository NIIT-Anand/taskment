<?php

declare(strict_types=1);

namespace App\Enums;

use App\Attributes\BackgroundColor;
use App\Attributes\Description;
use App\Attributes\Label;
use App\Concerns\AttributableEnum;
use App\Concerns\ValuableEnum;
use Filament\Support\Contracts\HasLabel;

enum UserPosition: string implements HasLabel
{
    use AttributableEnum, ValuableEnum;

    #[Description('')]
    #[BackgroundColor('red')]
    #[Label('Admin')]
    case ADMIN = 'Admin';

    #[Description('')]
    #[BackgroundColor('pink')]
    #[Label('BA')]
    case BA = 'BA';

    #[Description('')]
    #[BackgroundColor('purple')]
    #[Label('QA')]
    case QA = 'QA';

    #[Description('')]
    #[BackgroundColor('black')]
    #[Label('Manager')]
    case MANAGER = 'Manager';

    #[Description('')]
    #[BackgroundColor('gray')]
    #[Label('Developer')]
    case DEVELOPER = 'Developer';

    #[Description('')]
    #[BackgroundColor('orange')]
    #[Label('Reporting Manager')]
    case REPORTING_MANAGER = 'Reporting Manager';

    #[Description('')]
    #[BackgroundColor('yellow')]
    #[Label('Architecture Manager')]
    case ARCHITECTURE_MANAGER = 'Architecture Manager';
}
