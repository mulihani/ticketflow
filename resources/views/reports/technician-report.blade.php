@extends('layouts.reports.app')
@section('content')

    <div class="ticket">
        <!-- Report title -->
        <h2 class="text-center">{{ __('report.title_technician_tickets_summary_report') }}</h2>

        <!-- User information -->
        <p><strong> {{__('report.user_name')}} </strong> : {{ $record->name }}<br />
        <strong> {{__('report.user_email')}} </strong> : {{ $record->email }}</p>

        <!-- Tickets summary -->
        <table class="text-center">
            <tr>
                <td class="title">{{ __('report.ticket_status') }}</td>
                <td class="title">{{ __('report.ticket_count')}}</td>
            </tr>
            <tr>
                <td>{{ __('report.ticket_open') }}</td>
                <td>{{ userTicketCount('open','staff_id', $record->id) }}</td>
            </tr>
            <tr>
                <td>{{ __('report.ticket_closed') }}</td>
                <td>{{ userTicketCount('closed','staff_id', $record->id) }}</td>
            </tr>
            <tr>
                <td>{{ __('report.ticket_processing') }}</td>
                <td>{{userTicketCount('processing','staff_id', $record->id) }}</td>
            </tr>
            <tr>
                <td class="title">{{ __('report.ticket_total') }}</td>
                <td class="title"> {{ userTicketCount('','staff_id', $record->id) }}</td>
            </tr>
        </table>

    </div>

@endsection