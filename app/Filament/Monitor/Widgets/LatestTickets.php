<?php

namespace App\Filament\Monitor\Widgets;

use App\Models\Ticket;
use App\Models\Setting;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Support\Enums\Alignment;

class LatestTickets extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 0;

    public function table(Table $table): Table
    {
        if ( !Setting::getSetting('ticket_monitor_status') ) {
            
            return $table
                ->query( Ticket::latest()->limit(0) )
                ->columns([])
                ->paginated(false)
                ->heading('');

        } else {

            return $table
                ->query(
                    Ticket::latest()->limit(6) // Get last 10 records
                )
                ->columns([
                    TextColumn::make('id')
                        ->label(__('ticket.ticket_number_label'))
                        ->alignment(Alignment::Center),
                    TextColumn::make('category.name')
                        ->label(__('ticket.category')),
                    TextColumn::make('staff.name')
                        ->label(__('ticket.technician')),
                    TextColumn::make('status')
                        ->label(__('ticket.status'))
                        ->badge()
                        ->color(fn (string $state): string => match ($state) {
                            'processing' => 'warning',
                            'closed' => 'success',
                            'open' => 'danger',
                        }),
                    TextColumn::make('author_name')
                        ->label(__('ticket.name')),
                    TextColumn::make('author_ext')
                        ->label(__('ticket.extension')),
                    TextColumn::make('created_at')
                        ->label(__('ticket.created_at'))
                        ->dateTime()
                        ->since(),
                ])
                ->paginated(false)
                ->heading( __('ticket.latest_tickets') )
                ->poll('5s');

        }
    }

}
