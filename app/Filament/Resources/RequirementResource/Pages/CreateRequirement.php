<?php

declare(strict_types=1);

namespace App\Filament\Resources\RequirementResource\Pages;

use App\Filament\Resources\RequirementResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateRequirement extends CreateRecord
{
    protected static string $resource = RequirementResource::class;
}
