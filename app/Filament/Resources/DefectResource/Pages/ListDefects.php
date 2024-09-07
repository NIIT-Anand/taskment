<?php

declare(strict_types=1);

namespace App\Filament\Resources\DefectResource\Pages;

use App\Filament\Resources\DefectResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

final class ListDefects extends ListRecords
{
    protected static string $resource = DefectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
