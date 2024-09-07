<?php

declare(strict_types=1);

namespace App\Filament\Resources\DefectResource\Pages;

use App\Filament\Resources\DefectResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateDefect extends CreateRecord
{
    protected static string $resource = DefectResource::class;
}
