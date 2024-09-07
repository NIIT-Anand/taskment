<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Models\Defect;
use App\Models\Project;
use App\Models\Task;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

final class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '10s';

    protected function getStats(): array
    {
        return [
            Stat::make('Total Projects', Project::count())
                ->description('Number of active projects')
                ->descriptionIcon('heroicon-s-arrow-trending-up')
                ->color('success'),
            Stat::make('Open Tasks', Task::where('status', '!=', 'Completed')->count())
                ->description('Tasks in progress')
                ->descriptionIcon('heroicon-s-clock')
                ->color('warning'),
            Stat::make('Open Defects', Defect::where('status', '!=', 'Closed')->count())
                ->description('Defects to be resolved')
                ->descriptionIcon('heroicon-s-exclamation-triangle')
                ->color('danger'),
        ];
    }
}
