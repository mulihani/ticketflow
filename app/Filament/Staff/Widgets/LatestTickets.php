<?php

namespace App\Filament\Staff\Widgets;

use App\Models\Ticket;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Support\Enums\Alignment;

class LatestTickets extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 4;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Ticket::where('staff_id', auth()->id())->latest()->limit(10) // Get last 10 records
            )
            ->columns([
                TextColumn::make('id')
                    ->label(__('ticket.ticket_number_label'))
                    ->searchable()
                    ->sortable()
                    ->alignment(Alignment::Center),
                TextColumn::make('category.name')
                    ->label(__('ticket.category'))
                    ->sortable(),
                TextColumn::make('user.name')
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
            ]);
    }

}
