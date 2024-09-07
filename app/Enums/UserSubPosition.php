<?php

declare(strict_types=1);

namespace App\Enums;

use App\Attributes\Description;
use App\Concerns\AttributableEnum;
use App\Concerns\ValuableEnum;
use Filament\Support\Contracts\HasLabel;

enum UserSubPosition: string implements HasLabel
{
    use AttributableEnum, ValuableEnum;

    #[Description('')]
    case SENIOR = 'Senior';

    #[Description('')]
    case REGULAR = 'Regular';

    #[Description('')]
    case JUNIOR = 'Junior';

    #[Description('')]
    case INTERN = 'Intern';

    #[Description('')]
    case FRESHER = 'Fresher';
}
