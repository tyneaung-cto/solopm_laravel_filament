<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaskStatusResource\Pages;
use App\Models\TaskStatus;
use Filament\Actions\CreateAction as ActionsCreateAction;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;

class TaskStatusResource extends Resource
{
    protected static ?string $model = TaskStatus::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-view-columns';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            \Filament\Schemas\Components\Form::make([
                TextInput::make('label')
                    ->required()
                    ->maxLength(255),

                TextInput::make('key')
                    ->required()
                    ->maxLength(255),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('label')->sortable()->searchable(),
                TextColumn::make('key')->sortable()->searchable(),
            ])
            ->headerActions([
                ActionsCreateAction::make(),
            ])
            ->defaultSort('position')
            ->reorderable('position');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTaskStatuses::route('/'),
            'create' => Pages\CreateTaskStatus::route('/create'),
            'edit' => Pages\EditTaskStatus::route('/{record}/edit'),
        ];
    }
}
