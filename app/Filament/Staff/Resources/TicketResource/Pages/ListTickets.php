<?php

namespace App\Filament\Staff\Resources\TicketResource\Pages;

use App\Filament\Staff\Resources\TicketResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTickets extends ListRecords
{
    protected static string $resource = TicketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            TicketResource\Widgets\Tickets::class
        ];
    }
}
