<?php

namespace App\Filament\Resources\TaskStatuses\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TaskStatusesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('position')
            ->reorderable('position')
            ->columns([
                TextColumn::make('position')
                    ->numeric()
                    ->sortable()
                    ->label('Order'),

                TextColumn::make('label'),

                TextColumn::make('key')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'backlog' => 'gray',
                        'todo' => 'info',
                        'done-by-dev' => 'warning',
                        'completed' => 'success',
                        default => 'secondary',
                    }),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
