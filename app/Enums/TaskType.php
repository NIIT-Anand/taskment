<?php

declare(strict_types=1);

namespace App\Enums;

use App\Attributes\BackgroundColor;
use App\Attributes\Description;
use App\Concerns\AttributableEnum;
use App\Concerns\ValuableEnum;
use Filament\Support\Contracts\HasLabel;

enum TaskType: string implements HasLabel
{
    use AttributableEnum, ValuableEnum;

    #[Description('')]
    #[BackgroundColor('')]
    case REGULAR = 'Regular';

    #[Description('')]
    #[BackgroundColor('')]
    case CHANGE_REQUEST = 'Change Request';
}
