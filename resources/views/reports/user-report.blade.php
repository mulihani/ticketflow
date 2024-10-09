@extends('layouts.reports.app')
@section('content')

    <div class="ticket">
		<!-- Report title -->
		<h2 class="text-center">{{ __('report.title_user_tickets_summary_report') }}</h2>

		<!-- User information -->
		<p><strong> {{__('report.user_name')}} </strong> : {{ $record->name }}<br />
        <strong> {{__('report.user_email')}} </strong> : {{ $record->email }}<br />
        <strong> {{__('report.user_employment_id')}} </strong> : {{ $record->employee_id }}<br />
        <strong> {{__('report.user_mobile')}} </strong> : {{ $record->mobile }}</p>
		
		<!-- Tickets summary -->
		<table class="text-center">
			<tr>
				<td class="title">{{ __('report.ticket_status') }}</td>
				<td class="title">{{ __('report.ticket_count')}}</td>
			</tr>
			<tr>
				<td>{{ __('report.ticket_open') }}</td>
				<td>{{ userTicketCount('open', 'user_id', $record->id) }}</td>
			</tr>
			<tr>
				<td>{{ __('report.ticket_closed') }}</td>
				<td>{{ userTicketCount('closed', 'user_id', $record->id) }}</td>
			</tr>
			<tr>
				<td>{{ __('report.ticket_processing') }}</td>
				<td>{{ userTicketCount('processing', 'user_id', $record->id) }}</td>
			</tr>
			<tr>
				<td class="title">{{ __('report.ticket_total') }}</td>
				<td class="title">{{userTicketCount('', 'user_id', $record->id) }}</td>
			</tr>
		</table>

	</div>

@endsection