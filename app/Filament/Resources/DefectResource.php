<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Enums\DefectSeverity;
use App\Enums\DefectStatus;
use App\Filament\Resources\DefectResource\Pages;
use App\Models\Defect;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

final class DefectResource extends Resource
{
    protected static ?string $model = Defect::class;

    protected static ?string $navigationIcon = 'heroicon-o-bug-ant';

    protected static ?string $navigationGroup = 'Resources';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Group::make()->schema([
                        Forms\Components\Select::make('project_id')
                            ->relationship(name: 'project', titleAttribute: 'name')
                            ->required(),
                        Forms\Components\Select::make('task_id')
                            ->relationship(name: 'task', titleAttribute: 'name'),
                    ])->columns(2),
                    Forms\Components\RichEditor::make('description')
                        ->required()
                        ->maxLength(65535)
                        ->columnSpan('full'),
                ]),
                Forms\Components\Group::make()->schema([
                    Forms\Components\Group::make()->schema([
                        Forms\Components\Select::make('reported_by')
                            ->relationship(name: 'reportedBy', titleAttribute: 'name')
                            ->required(),
                        Forms\Components\Select::make('severity')
                            ->options(DefectSeverity::class)
                            ->required()
                            ->searchable(),
                        Forms\Components\Select::make('status')
                            ->options(DefectStatus::class)
                            ->required()
                            ->searchable(),
                    ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('project.name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('task.name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('reportedBy.name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('severity')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
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
            DefectResource\RelationManagers\ProjectRelationManager::class,
            DefectResource\RelationManagers\TaskRelationManager::class,
            DefectResource\RelationManagers\ReportedByRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDefects::route('/'),
            'create' => Pages\CreateDefect::route('/create'),
            'edit' => Pages\EditDefect::route('/{record}/edit'),
        ];
    }
}
