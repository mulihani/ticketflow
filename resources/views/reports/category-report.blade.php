@extends('layouts.reports.app')

@section('content')

<div class="ticket">
    <!-- Report title -->
	<h2 class="text-center">{{ __('report.title_category_tickets_summary_report') }}</h2>

    <!-- Category information -->
    <p><strong> {{__('report.category_id')}} </strong> : {{ $record->id }}<br />
    <strong> {{__('report.category_name')}} </strong> : {{ $record->name }}<br />
    <strong> {{__('report.category_description')}} </strong> : {{ $record->description }}<br />


    <table class="text-center">
        <tr>
            <td class="title">{{ __('report.ticket_status') }}</td>
            <td class="title">{{ __('report.ticket_count')}}</td>
        </tr>
        <tr>
            <td>{{ __('report.ticket_open') }}</td>
            <td>{{ $record->open_tickets()->count() }}</td>
        </tr>
        <tr>
            <td>{{ __('report.ticket_closed') }}</td>
            <td>{{ $record->closed_tickets()->count() }}</td>
        </tr>
        <tr>
            <td>{{ __('report.ticket_processing') }}</td>
            <td>{{ $record->processing_tickets()->count() }}</td>
        </tr>
        <tr>
            <td class="title">{{ __('report.ticket_total') }}</td>
            <td class="title">{{ $record->tickets()->count() }}</td>
        </tr>
    </table>
</div>

@endsection