<?php

namespace App\Filament\Resources\Notes\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Schemas\Schema;

class NoteInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('content')
                    ->hiddenLabel()
                    ->placeholder('-')
                    ->html()
                    ->prose()
                    ->columnSpanFull(),
                TextEntry::make('is_share')
                    ->label('Share Status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state ? 'Shared' : 'Private')
                    ->color(fn ($state) => $state ? 'success' : 'gray'),
                TextEntry::make('user.name')
                    ->label('User'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
