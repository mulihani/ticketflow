<?php

namespace App\Filament\Admin\Resources\TicketResource\Pages;

use App\Filament\Admin\Resources\TicketResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListTickets extends ListRecords
{
    protected static string $resource = TicketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('ticketspdf') 
                ->label('PDF')
                ->color('success')
                ->icon('heroicon-m-arrow-down-tray')
                ->url(route('generatePdf','tickets'))
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            TicketResource\Widgets\Tickets::class
        ];
    }

}
