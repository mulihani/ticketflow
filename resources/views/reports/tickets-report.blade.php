@extends('layouts.reports.app')

@section('content')

<div class="ticket">
    <!-- Report title -->
	<h2 class="text-center">{{ __('report.title_tickets_summary_report') }}</h2>

    <!-- Tickets summary -->
    <table class="text-center">
        <tr>
            <td class="title">{{ __('report.ticket_status') }}</td>
            <td class="title">{{ __('report.ticket_count')}}</td>
        </tr>
        <tr>
            <td>{{ __('report.ticket_open') }}</td>
            <td>{{ App\Models\Ticket::ticketCount('open')}}</td>
        </tr>
        <tr>
            <td>{{ __('report.ticket_closed') }}</td>
            <td>{{ App\Models\Ticket::ticketCount('closed') }}</td>
        </tr>
        <tr>
            <td>{{ __('report.ticket_processing') }}</td>
            <td>{{ App\Models\Ticket::ticketCount('processing') }}</td>
        </tr>
        <tr>
            <td class="title">{{ __('report.ticket_total') }}</td>
            <td class="title">{{ App\Models\Ticket::ticketCount() }}</td>
        </tr>
    </table>
</div>

@endsection