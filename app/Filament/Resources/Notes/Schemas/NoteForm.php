<?php

namespace App\Filament\Resources\Notes\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Schemas\Components\Grid as ComponentsGrid;
use Filament\Schemas\Components\Section as ComponentsSection;
use Filament\Schemas\Components\Tabs as ComponentsTabs;
use Filament\Schemas\Components\Tabs\Tab as TabsTab;

class NoteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ComponentsTabs::make('Note Tabs')
                    ->tabs([
                        TabsTab::make('Content')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                ComponentsSection::make('Note Details')
                                    ->description('Write and manage your note content here.')
                                    ->schema([
                                        TextInput::make('title')
                                            ->required()
                                            ->maxLength(255)
                                            ->columnSpanFull(),

                                        RichEditor::make('content')
                                            ->required()
                                            ->columnSpanFull()
                                            ->extraAttributes([
                                                'style' => 'min-height: 300px;',
                                            ]),
                                    ])
                                    ->columns(1),
                            ]),

                        TabsTab::make('Settings')
                            ->icon('heroicon-o-cog-6-tooth')
                            ->schema([
                                ComponentsSection::make('Ownership')
                                    ->description('Control who owns this note.')
                                    ->schema([
                                        ComponentsGrid::make(1)
                                            ->schema([
                                                Select::make('user_id')
                                                    ->relationship('user', 'name')
                                                    ->default(fn() => auth()->id())
                                                    ->disabled(fn() => auth()->user()->isAdmin() === false)
                                                    ->required(),

                                                Toggle::make('is_share')
                                                    ->label('Share with others')
                                                    ->helperText('If enabled, other users can view this note (read-only).')
                                                    ->default(false),
                                            ]),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
