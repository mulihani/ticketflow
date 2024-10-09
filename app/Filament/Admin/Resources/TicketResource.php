<?php

namespace App\Filament\Admin\Resources;

use PDF;
use App\Models\Ticket;
use App\Models\Category;
use App\Models\Section;
use App\Models\User;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Filament\Admin\Resources\TicketResource\Pages;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\Filter;
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


class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-m-ticket';

    protected static ?int $navigationSort = 4;

    protected static ?string $recordTitleAttribute = 'id';

    public static function getNavigationBadge(): ?string
    {
        return Ticket::whereDate('created_at', today())->count();
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

                Forms\Components\Section::make(__('ticket.customer_info'))
                    ->description(__('ticket.customer_data'))
                        ->schema([
                            TextInput::make('author_id')
                                ->prefix( __('ticket.author_id') )
                                ->label(''),
                            TextInput::make('author_name')
                                ->required()
                                ->label('')
                                ->prefix( __('ticket.name') )
                                ->maxLength(255),
                            TextInput::make('author_mobile')
                                ->label('')
                                ->prefix( __('ticket.mobile') )
                                ->maxLength(255),
                            TextInput::make('author_ext')
                                ->label('')
                                ->prefix( __('ticket.extension') )
                                ->maxLength(255),
                            TextInput::make('author_ip')
                                ->prefix( __('ticket.ip') )
                                ->label(''),
                            Select::make('section_id')
                                ->label('')
                                ->prefix( __('ticket.section') )
                                ->options(Section::all()->pluck('name', 'id'))
                                ->searchable(),
                        ])->columns(3),

                Forms\Components\Section::make(__('ticket.issue_info').' '.__('ticket.ticket_number_label').' ['. @$form->getRecord()->id.']')
                    ->schema([
                        Select::make('category_id')
                            ->label(__('ticket.category'))
                                ->options(Category::all()->pluck('name', 'id'))
                                ->searchable()
                                ->required()
                                ->preload(),
                        Select::make('staff_id')
                            ->label(__('ticket.technician'))
                                ->options(User::whereIn('type',['admin', 'staff'])->pluck('name', 'id'))
                                ->searchable()
                                ->preload(),
                        Select::make('status')
                            ->label(__('ticket.status'))
                            ->options([
                                'open' => __('ticket.open'),
                                'closed' => __('ticket.closed'),
                                'processing' => __('ticket.processing'),
                            ])
                            ->searchable()
                            ->preload(),
                        RichEditor::make('content')
                            ->label(__('ticket.issue_info'))
                            ->columnSpanFull()
                            ->toolbarButtons([
                                'bold',
                                'bulletList',
                                'h2',
                                'italic',
                                'orderedList',
                                'underline'
                            ]),
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
                    ])->columns(3),

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
                TextColumn::make('id')
                    ->label(__('ticket.ticket_number_label'))
                    ->searchable()
                    ->sortable()
                    ->alignment(Alignment::Center),
                TextColumn::make('category.name')
                    ->label(__('ticket.category'))
                    ->sortable(),
                TextColumn::make('staff.name')
                    ->label(__('ticket.technician'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->label(__('ticket.status'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'processing' => 'warning',
                        'closed' => 'success',
                        'open' => 'danger',
                    })
                    ->sortable(),
                TextColumn::make('author_name')
                    ->label(__('ticket.name'))
                    ->searchable(),
                TextColumn::make('author_ip')
                    ->label(__('ticket.ip'))
                    ->alignment(Alignment::Center)
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('author_mobile')
                    ->label(__('ticket.mobile'))
                    ->alignment(Alignment::Center)
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('author_ext')
                    ->label(__('ticket.extension'))
                    ->searchable()
                    ->alignment(Alignment::Center)
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('author_id')
                    ->label(__('ticket.author_id'))
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from')->label(__('ticket.created_from')),
                        DatePicker::make('created_until')->label(__('ticket.created_until')),
                    ])->columns(1)
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
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
                Tables\Filters\SelectFilter::make('section')
                    ->label(__('ticket.section'))
                    ->relationship('section', 'name'),
                Tables\Filters\SelectFilter::make('user')
                    ->label(__('ticket.technician'))
                    ->relationship('staff', 'name', fn (Builder $query) => $query->whereIn('type',['admin', 'staff'])),
            ] , layout: Tables\Enums\FiltersLayout::AboveContent)
            ->filtersFormColumns(5)

            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('pdf') 
                    ->label('PDF')
                    ->color('success')
                    ->icon('heroicon-m-arrow-down-tray')
                    ->action(function (Ticket $record) {
                        return response()->streamDownload(function () use ($record) {
                            echo PDF::loadHtml(
                                Blade::render('reports.ticket-report', ['record' => $record])
                            )->stream();
                        }, 'ticket-'.$record->id . '.pdf');
                    }), 
            ])

            ->headerActions([
                // ...
            ])

            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),

                Tables\Actions\BulkAction::make('CollectionPDF') 
                    ->label('PDF')
                    ->color('success')
                    ->icon('heroicon-m-arrow-down-tray')
                    ->action(function (Collection $records) {
                        return response()->streamDownload(function () use ($records) {
                            echo PDF::loadHtml(
                                Blade::render('reports.selected-tickets-report', ['records' => $records])
                            )->stream();
                        }, 'selected-tickets.pdf');
                    }),
            ]);
    }

    /*
    |--------------------------------------------------------------------------
    |  Resource pages settings
    |--------------------------------------------------------------------------
    */

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
        ];
    }
}
