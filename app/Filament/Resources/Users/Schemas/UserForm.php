<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('User Information')->schema([
                    TextInput::make('name')
                        ->required(),

                    TextInput::make('email')
                        ->label('Email address')
                        ->email()
                        ->unique()
                        ->rule('email:rfc,dns')
                        ->rule('indisposable')
                        ->required(),

                    TextInput::make('password')
                        ->password()
                        ->revealable()
                        ->required(fn(string $context) => $context === 'create')
                        ->dehydrated(fn($state) => filled($state))
                        ->dehydrateStateUsing(fn($state) => filled($state) ? bcrypt($state) : null),
                    // Using Select Component
                    Select::make('roles')
                        ->relationship('roles', 'name')
                        ->preload()
                        ->searchable(),
                    DateTimePicker::make('email_verified_at')->default(now()),
                ]),



                // Textarea::make('two_factor_secret')
                //     ->columnSpanFull(),
                // Textarea::make('two_factor_recovery_codes')
                //     ->columnSpanFull(),
                // DateTimePicker::make('two_factor_confirmed_at'),
            ]);
    }
}
