<?php

namespace App\Filament\Resources\Notes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Filters\SelectFilter;

class NotesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->filters([
                SelectFilter::make('scope')
                    ->label('')
                    ->options([
                        'my' => 'My Notes',
                        'shared' => 'Shared With Me',
                    ])
                    ->default('my')
                    ->indicator(false)
                    ->query(function ($query, array $data) {
                        return match ($data['value'] ?? null) {
                            'shared' => $query
                                ->where('is_share', true)
                                ->where('user_id', '!=', auth()->id()),
                            default => $query
                                ->where('user_id', auth()->id()),
                        };
                    }),
            ])
            ->filtersFormColumns(3)
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->columns([
                Stack::make([
                    TextColumn::make('title')
                        ->weight('bold')
                        ->size('lg')
                        ->searchable()
                        ->wrap(),

                    TextColumn::make('content')
                        ->html()
                        ->wrap()
                        ->color('gray')
                        ->extraAttributes([
                            'class' => 'prose prose-invert max-w-none [&_img]:rounded-lg [&_img]:max-h-48 [&_img]:object-cover',
                        ]),

                    TextColumn::make('is_share')
                        ->badge()
                        ->formatStateUsing(fn($state) => $state ? 'Shared' : 'Private')
                        ->color(fn($state) => $state ? 'success' : 'gray'),

                    Split::make([
                        TextColumn::make('user.name')
                            ->badge()
                            ->color('primary'),

                        TextColumn::make('updated_at')
                            ->since()
                            ->color('gray')
                            ->size('sm'),
                    ]),
                ])
                    ->extraAttributes([
                        'class' => 'break-inside-avoid mb-6 p-3 rounded-xl border border-gray-800 bg-gray-900 shadow-sm hover:shadow-lg transition',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),

                EditAction::make()
                    ->visible(fn($record) => $record->user_id === auth()->id()),

                DeleteAction::make()
                    ->visible(fn($record) => $record->user_id === auth()->id()),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // DeleteBulkAction::make(),
                ]),
            ]);
    }
}
