<?php

declare(strict_types=1);

namespace App\Filament\Pages;

use Filament\Pages\Page;

final class MyTasks extends Page
{
    public $user;

    public $tasks;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.my-tasks';

    protected static ?string $title = 'My Tasks';

    public function mount(): void
    {
        $this->user = auth()->user();
        $this->tasks = $this->user->tasks()
            ->with('project')
            ->get()
            ->groupBy('project.name');
    }
}
