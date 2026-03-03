<?php

namespace App\Filament\Resources\TaskStatuses\Schemas;

use App\Models\TaskStatus;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class TaskStatusForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Main Input')
                    ->schema([
                        TextInput::make('label')
                            ->required()
                            ->unique()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, callable $set) {
                                $set('key', Str::slug($state));
                            }),
                    ])->columnSpanFull(),

                Section::make('Auto Generated')
                    ->schema([
                        TextInput::make('key')
                            ->required()
                            ->disabled()
                            ->unique()
                            ->dehydrated(),

                        TextInput::make('position')
                            ->required()
                            ->numeric()
                            ->disabled()
                            ->unique()
                            ->default(fn() => (TaskStatus::max('position') ?? 0) + 1),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),


            ]);
    }
}
