@extends('layouts.reports.app')

@section('content')

@php 
    $counter = 1;
@endphp

<div class="ticket">
    <!-- Report title -->
	<h2 class="text-center">{{ __('report.title_categories_tickets_summary_report') }}</h2>

    <!-- Tickets summary -->
    <table class="text-center">
        <tr>
            <td class="title"> # </td>
            <td class="title"> {{__('report.category_name')}} </td>
            <td class="title"> {{__('report.ticket_open_lable')}} </td>
            <td class="title"> {{__('report.ticket_processing_lable')}} </td>
            <td class="title"> {{__('report.ticket_closed_lable')}} </td>
            <td class="title"> {{__('report.ticket_total')}} </td>
        </tr>
        @foreach (App\Models\Category::getCategories() as $record)
        <tr>
            <td> {{ $counter++ }} </td>
            <td class="text-justify"> {{ $record->name }} </td>
            <td> {{ $record->open_tickets()->count() }} </td>
            <td> {{ $record->processing_tickets()->count() }} </td>
            <td> {{ $record->closed_tickets()->count() }} </td>
            <td> {{  $record->open_tickets()->count() + $record->processing_tickets()->count() + $record->closed_tickets()->count() }} </td>
        </tr>
        @endforeach
    </table>
</div>

@endsection