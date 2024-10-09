@extends('layouts.reports.app')
@section('content')

    @php 
        $counter = 1;
    @endphp

    <div class="ticket">
        <!-- Report title -->
        <h2 class="text-center">{{ __('report.title_staff_tickets_summary_report') }}</h2>

        <!-- Tickets summary -->
        <table class="text-center">
            <tr>
                <td class="title"> # </td>
                <td class="title"> {{__('report.user_name')}} </td>
                <td class="title"> {{__('report.ticket_open_lable')}} </td>
                <td class="title"> {{__('report.ticket_processing_lable')}} </td>
                <td class="title"> {{__('report.ticket_closed_lable')}} </td>
                <td class="title"> {{__('report.ticket_total')}} </td>
            </tr>
            @foreach (App\Models\User::where('type','!=', 'user')->orderBy('id')->get() as $record)
            <tr>
                <td> {{ $counter++ }} </td>
                <td class="text-justify"> {{ $record->name }} </td>
                <td> {{ $record->staff_open_tickets()->count() }} </td>
                <td> {{ $record->staff_processing_tickets()->count() }} </td>
                <td> {{ $record->staff_closed_tickets()->count() }} </td>
                <td> {{  $record->staff_open_tickets()->count() + $record->staff_processing_tickets()->count() + $record->staff_closed_tickets()->count() }} </td>
            </tr>
            @endforeach
        </table>
    </div>

@endsection