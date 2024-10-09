<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Ticket;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Tickets extends BaseWidget
{
    protected function getStats(): array
    {

        return [
            Stat::make( __('ticket.tickets_today') , Ticket::whereDate('created_at', date('Y-m-d'))->count())
            ->description(__('ticket.tickets_added_today'))
            ->descriptionIcon('heroicon-o-ticket')
            ->color('info')
            ->chart([10,9,8,7]),

            Stat::make( __('ticket.open_tickets'), Ticket::where('status','open')->count())
            ->description( __('ticket.still_open_tickets') )
            ->descriptionIcon('heroicon-m-stop-circle')
            ->color('danger')
            ->chart([10,9,8,7]),

            Stat::make( __('ticket.in_progress_tickets') , Ticket::where('status','processing')->count())
            ->description( __('ticket.still_in_progress_tickets') )
            ->descriptionIcon('heroicon-m-arrow-path-rounded-square')
            ->color('warning')
            ->chart([10,9,8,7]),

            Stat::make( __('ticket.total_tickets') , Ticket::all()->count())
            ->description( __('ticket.ttal_of_all_tickets') )
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success')
            ->chart([10,9,8,7]),
        ];
    }
}
