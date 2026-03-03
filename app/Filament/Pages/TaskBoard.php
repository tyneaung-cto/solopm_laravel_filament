<?php

namespace App\Filament\Pages;

use App\Models\Task;
use App\Models\TaskStatus;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Relaticle\Flowforge\Board;
use Relaticle\Flowforge\BoardPage;
use Relaticle\Flowforge\Column;
use Relaticle\Flowforge\Components\CardFlex;

class TaskBoard extends BoardPage
{
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-view-columns';

    protected static ?string $navigationLabel = 'Task Board';

    protected static ?string $title = 'Task Board';

    public function getMaxContentWidth(): ?string
    {
        return 'full';
    }

    public function getHeading(): ?string
    {
        return null;
    }

    public function board(Board $board): Board
    {
        return $board
            ->query($this->getEloquentQuery())
            ->recordTitleAttribute('title')
            ->columnIdentifier('status')
            ->positionIdentifier('position') // Enable drag-and-drop with position field
            ->cardSchema(fn(Schema $schema) => $schema->components([

                TextEntry::make('description')
                    ->hiddenLabel()
                    ->formatStateUsing(fn($state) => Str::limit(strip_tags($state), 120))
                    ->color('gray'),
                CardFlex::make([
                    TextEntry::make('priority')
                        ->hiddenLabel()
                        ->badge()
                        ->color(fn($state) => match ($state) {
                            'high' => 'danger',
                            'medium' => 'warning',
                            'low' => 'success',
                            default => 'gray',
                        }),

                    TextEntry::make('due_date')
                        ->hiddenLabel()
                        ->date()
                        ->icon('heroicon-o-calendar')
                        ->color(function ($state) {
                            if (! $state) {
                                return 'gray';
                            }

                            $due = \Illuminate\Support\Carbon::parse($state)->startOfDay();
                            $today = now()->startOfDay();

                            // Signed difference (negative = past, positive = future)
                            $days = $today->diffInDays($due, false);

                            if ($days < 0) {
                                return 'danger'; // Overdue
                            }

                            if ($days <= 2) {
                                return 'danger'; // Very near
                            }

                            if ($days <= 5) {
                                return 'warning'; // Near
                            }

                            return 'success'; // Far future
                        })
                        ->extraAttributes(function ($state) {
                            if (! $state) {
                                return [];
                            }

                            $due = \Illuminate\Support\Carbon::parse($state)->startOfDay();
                            $today = now()->startOfDay();
                            $days = $today->diffInDays($due, false);

                            if ($days < 0) {
                                return [
                                    'class' => 'line-through font-semibold',
                                ];
                            }

                            return [];
                        }),

                    TextEntry::make('assignee.name')
                        ->hiddenLabel()
                        ->icon('heroicon-o-user')
                        ->color('gray'),
                ])->wrap()->justify('start')->align('center'),
            ]))
            ->actions([
                // Action::make('create')
                //     ->label('Create Task')
                //     ->icon('heroicon-o-plus')
                //     ->form([
                //         TextInput::make('title')->required()->maxLength(255),
                //         RichEditor::make('description')
                //             ->fileAttachmentsAcceptedFileTypes([
                //                 'image/png',
                //                 'image/jpeg',
                //                 'image/gif',
                //                 'image/webp',
                //                 'application/pdf',
                //             ])
                //             ->fileAttachmentsMaxSize(51200),
                //         Select::make('status')
                //             ->options(fn () => TaskStatus::orderBy('position')->pluck('label', 'key')->toArray())
                //             ->default(fn () => TaskStatus::orderBy('position')->value('key'))
                //             ->required(),
                //         Select::make('priority')
                //             ->options([
                //                 'low' => 'Low',
                //                 'medium' => 'Medium',
                //                 'high' => 'High',
                //             ])
                //             ->default('medium')
                //             ->required(),
                //         TextInput::make('due_date')->type('date'),
                //         Select::make('user_id')
                //             ->label('Assignee')
                //             ->relationship('assignee', 'name')
                //             ->searchable()
                //             ->preload()
                //             ->nullable(),
                //     ])
                //     ->action(function (array $data): void {
                //         $position = $this->getBoardPositionInColumn($data['status'] ?? 'todo', 'bottom');

                //         Task::create([
                //             'title' => $data['title'],
                //             'description' => $data['description'] ?? null,
                //             'status' => $data['status'] ?? 'todo',
                //             'position' => $position,
                //             'priority' => $data['priority'] ?? 'medium',
                //             'due_date' => $data['due_date'] ?? null,
                //             'user_id' => $data['user_id'] ?? auth()->user()?->id,
                //         ]);

                //         // Emit an event to refresh the board UI
                //         $this->dispatch('kanban-item-created');
                //     }),
            ])
            ->columnActions([
                CreateAction::make()
                    ->label('Add')
                    ->icon('heroicon-o-plus')
                    ->model(Task::class)
                    ->form([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(100)
                            ->live()
                            ->helperText(fn ($state) => strlen($state ?? '') . ' / 100 characters'),
                        RichEditor::make('description')
                            ->required()
                            ->extraAttributes([
                                'style' => 'min-height: 300px;',
                            ])
                            ->fileAttachmentsAcceptedFileTypes([
                                'image/png',
                                'image/jpeg',
                                'image/gif',
                                'image/webp',
                                'application/pdf',
                            ])
                            ->fileAttachmentsMaxSize(51200),
                        Select::make('priority')
                            ->options([
                                'low' => 'Low',
                                'medium' => 'Medium',
                                'high' => 'High',
                            ])
                            ->default('medium'),
                        DatePicker::make('due_date')
                            ->minDate(now()->addDay())
                            ->required(),
                        Select::make('user_id')
                            ->label('Assignee')
                            ->relationship('assignee', 'name')
                            ->searchable()
                            ->preload()
                            ->default(fn() => auth()->id())
                            ->nullable(),
                    ])
                    ->mutateFormDataUsing(function (array $data, array $arguments): array {
                        if (isset($arguments['column'])) {
                            $data['status'] = $arguments['column'];
                            $data['position'] = $this->getBoardPositionInColumn($arguments['column']);
                            if (! isset($data['user_id'])) {
                                $data['user_id'] = auth()->user()?->id;
                            }
                        }

                        return $data;
                    }),
            ])
            ->cardActions([
                EditAction::make()->model(Task::class)
                    ->form([
                        TextInput::make('title')->required()->maxLength(255),
                        RichEditor::make('description')
                            ->required()
                            ->extraAttributes([
                                'style' => 'min-height: 300px;',
                            ])
                            ->fileAttachmentsAcceptedFileTypes([
                                'image/png',
                                'image/jpeg',
                                'image/gif',
                                'image/webp',
                                'application/pdf',
                            ])
                            ->fileAttachmentsMaxSize(51200),
                        Select::make('user_id')
                            ->label('Assignee')
                            ->relationship('assignee', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Select::make('status')
                            ->options(fn() => TaskStatus::orderBy('position')->pluck('label', 'key')->toArray())
                            ->required(),
                        Select::make('priority')
                            ->options([
                                'low' => 'Low',
                                'medium' => 'Medium',
                                'high' => 'High',
                            ])
                            ->default('medium')
                            ->required(),
                        DatePicker::make('due_date')
                            ->minDate(now()->addDay())
                            ->required(false),
                    ]),
                DeleteAction::make()->model(Task::class),
            ])
            ->cardAction('edit')
            ->searchable(['title', 'description', 'assignee.name'])
            ->filters([
                SelectFilter::make('priority')
                    ->options([
                        'low' => 'Low',
                        'medium' => 'Medium',
                        'high' => 'High',
                    ])
                    ->multiple(),
                SelectFilter::make('assigned_to')
                    ->relationship('assignee', 'name')
                    ->searchable()
                    ->preload(),
                Filter::make('overdue')
                    ->label('Overdue')
                    ->query(fn(Builder $query) => $query->where('due_date', '<', now()))
                    ->toggle(),
            ])
            ->columns((function () {
                $columns = [];
                $statuses = TaskStatus::orderBy('position')->get();

                foreach ($statuses as $status) {
                    // Default color mapping - can be extended to persist color on TaskStatus
                    $color = match ($status->key) {
                        'todo' => 'gray',
                        'in_progress' => 'blue',
                        'completed' => 'green',
                        default => 'gray',
                    };

                    $columns[] = Column::make($status->key)->label($status->label)->color($color);
                }

                return $columns;
            })());
    }

    protected function getActions(): array
    {
        return $this->getBoard()->getActions();
    }

    public function getEloquentQuery(): Builder
    {
        return Task::query();
    }
}
