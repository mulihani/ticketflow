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
            <td>{{$records->where('status','open')->count()}}
            </td>
        </tr>
        <tr>
            <td>{{ __('report.ticket_closed') }}</td>
            <td>{{$records->where('status','closed')->count()}}</td>
        </tr>
        <tr>
            <td>{{ __('report.ticket_processing') }}</td>
            <td>{{$records->where('status','processing')->count()}}</td>
        </tr>
        <tr>
            <td class="title">{{ __('report.ticket_total') }}</td>
            <td class="title">{{ $records->where('status','open')->count() + $records->where('status','closed')->count() + $records->where('status','processing')->count() }}</td>
        </tr>
    </table>
</div>

@endsection