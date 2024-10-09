<?php

namespace App\Filament\Staff\Resources;

use App\Filament\Staff\Resources\TicketResource\Pages;
use App\Models\Ticket;
use App\Models\Category;
use App\Models\Section;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Support\Enums\Alignment;
use Illuminate\Database\Eloquent\Builder;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-m-ticket';

    protected static ?string $recordTitleAttribute = 'id';

    /*
    |--------------------------------------------------------------------------
    |  Show user-related tickets only
    |--------------------------------------------------------------------------
    */

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('staff_id', auth()->id());
    }

    /*
    |--------------------------------------------------------------------------
    |  Resource labels translation
    |--------------------------------------------------------------------------
    */

    public static function getModelLabel(): string
    {
        return __('ticket.ticket');
    }

    public static function getPluralModelLabel(): string
    {
        return __('ticket.tickets');
    }

    /*
    |--------------------------------------------------------------------------
    |  Resource form settings
    |--------------------------------------------------------------------------
    */

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\Section::make(__('ticket.customer_info'))
                    ->description(__('ticket.customer_data'))
                    ->schema([
                        TextInput::make('author_id')
                            ->disabled()
                            ->prefix( __('ticket.author_id') )
                            ->label(''),
                        TextInput::make('author_name')
                            ->disabled()
                            ->label('')
                            ->prefix( __('ticket.name') ),
                        TextInput::make('author_mobile')
                            ->disabled()
                            ->label('')
                            ->prefix( __('ticket.mobile') ),
                        TextInput::make('author_ext')
                            ->disabled()
                            ->label('')
                            ->prefix( __('ticket.extension') ),
                        TextInput::make('author_ip')
                            ->disabled()
                            ->prefix( __('ticket.ip') )
                            ->label(''),
                    ])->columns(3),

                Forms\Components\Section::make(__('ticket.issue_info'))
                    ->schema([
                        Select::make('category_id')
                            ->label(__('ticket.category'))
                                ->options(Category::all()->pluck('name', 'id'))
                                ->searchable()
                                ->required()
                                ->disabled(),
                        Select::make('user_id')
                            ->label(__('ticket.technician'))
                                ->options(User::all()->pluck('name', 'id'))
                                ->searchable()
                                ->disabled(),
                        Select::make('section_id')
                            ->label(__('ticket.section'))
                            ->options(Section::all()->pluck('name', 'id'))
                            ->searchable()
                            ->disabled(),
                        RichEditor::make('content')
                            ->label(__('ticket.issue_info'))
                            ->columnSpanFull()
                            ->disabled(),
                    ])->columns(3),

                Select::make('status')
                    ->label('')
                    ->prefix( __('ticket.status') )
                    ->suffix(__('ticket.ticket_number_label').' : '. $form->getRecord()->id)
                    ->options([
                        'open' => __('ticket.open'),
                        'closed' => __('ticket.closed'),
                        'processing' => __('ticket.processing'),
                    ])
                    ->searchable()
                    ->preload(),
                RichEditor::make('note')
                    ->label(__('ticket.troubleshooter_notes'))
                    ->columnSpanFull()
                    ->toolbarButtons([
                        'bold',
                        'bulletList',
                        'h2',
                        'italic',
                        'orderedList',
                        'underline'
                    ]),

            ]);
    }

    /*
    |--------------------------------------------------------------------------
    |  Resource table settings
    |--------------------------------------------------------------------------
    */

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('id')
                    ->label(__('ticket.ticket_number_label'))
                    ->searchable()
                    ->sortable()
                    ->alignment(Alignment::Center),
                TextColumn::make('category.name')
                    ->label(__('ticket.category'))
                    ->sortable(),
                TextColumn::make('section.name')
                    ->label(__('ticket.section'))
                    ->sortable(),
                TextColumn::make('author_ip')
                    ->label(__('ticket.ip'))
                    ->searchable(),
                TextColumn::make('author_name')
                    ->label(__('ticket.name'))
                    ->searchable(),
                TextColumn::make('author_mobile')
                    ->label(__('ticket.mobile'))
                    ->searchable(),
                TextColumn::make('author_ext')
                    ->label(__('ticket.extension'))
                    ->searchable(),
                TextColumn::make('status')
                    ->label(__('ticket.status'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'processing' => 'warning',
                        'closed' => 'success',
                        'open' => 'danger',
                    })
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label(__('ticket.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->since()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('ticket.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->since()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
                Tables\Filters\SelectFilter::make('status')
                    ->label(__('ticket.status'))
                    ->options([
                        'open' => __('ticket.open'),
                        'closed' => __('ticket.closed'),
                        'processing' => __('ticket.processing'),
                    ]),
                Tables\Filters\SelectFilter::make('category')
                    ->label(__('ticket.category'))
                    ->relationship('category', 'name'),
            ], layout: Tables\Enums\FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTickets::route('/'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDeleteAny(): bool
    {
        return false;
    }

}
