<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Ticket;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Support\Enums\Alignment;
use App\Filament\Admin\Resources\TicketResource\Pages;

class LatestTickets extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 4;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Ticket::latest()->limit(10) // Get last 10 records
            )
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('ticket.ticket_number_label'))
                    ->alignment(Alignment::Center),
                Tables\Columns\TextColumn::make('category.name')
                    ->label(__('ticket.category')),
                Tables\Columns\TextColumn::make('staff.name')
                    ->label(__('ticket.technician')),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('ticket.status'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'processing' => 'warning',
                        'closed' => 'success',
                        'open' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('author_ip')
                    ->label(__('ticket.ip'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('author_name')
                    ->label(__('ticket.name')),
                Tables\Columns\TextColumn::make('author_mobile')
                    ->label(__('ticket.mobile'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('author_ext')
                    ->label(__('ticket.extension')),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('ticket.created_at'))
                    ->dateTime()
                    ->since()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('ticket.updated_at'))
                    ->dateTime()
                    ->since()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->paginated(false)
            ->heading( __('ticket.latest_tickets') )
            ->poll('5s')
            ;
    }

}
