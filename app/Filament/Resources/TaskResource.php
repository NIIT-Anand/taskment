<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Enums\TaskStatus;
use App\Enums\TaskType;
use App\Filament\Resources\TaskResource\Pages;
use App\Models\Task;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

final class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document';

    protected static ?string $navigationGroup = 'Resources';

    protected static ?int $navigationSort = 3;

    public static function getGloballySearchableAttributes(): array
    {
        return [
            'name',
        ];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        /** @var Task $record */
        return ['name' => $record->name];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\RichEditor::make('description')
                        ->required()
                        ->maxLength(65535)
                        ->columnSpan('full'),
                ]),
                Forms\Components\Group::make()->schema([
                    Forms\Components\Select::make('project_id')
                        ->relationship(name: 'project', titleAttribute: 'name')
                        ->required(),
                    Forms\Components\Group::make()->schema([
                        Forms\Components\Select::make('status')
                            ->options(TaskStatus::class)
                            ->required()
                            ->searchable(),
                        Forms\Components\Select::make('type')
                            ->options(TaskType::class)
                            ->required()
                            ->searchable(),
                    ]),
                    Forms\Components\Group::make()->schema([
                        Forms\Components\Select::make('assigned_ba_id')
                            ->label('BA')
                            ->relationship(name: 'assignedBa', titleAttribute: 'name')
                            ->required(),
                    ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('project.name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            TaskResource\RelationManagers\RequirementsRelationManager::class,
            TaskResource\RelationManagers\DefectsRelationManager::class,
            TaskResource\RelationManagers\AssignedToRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }
}
