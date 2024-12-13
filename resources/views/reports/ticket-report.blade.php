@extends('layouts.reports.app')

@section('content')

<div class="ticket">

    <!-- Report title -->
	<h2 class="text-center">{{ __('report.title_ticket_report') }}</h2>

    <!-- User information -->
    <p>
        <strong> {{__('report.user_name')}} </strong> : {{ $record->author_name }}<br>
        <strong> {{__('report.user_employment_id')}} </strong> : {{ $record->author_id }}<br>
        <strong> {{__('report.user_mobile')}} </strong> : {{ $record->author_mobile }}
    </p>

    <!-- Ticket information -->
    <table class="text-center">
        <tr>
            <td class="title"><strong> {{__('report.ticket_number')}} </strong></td>
            <td class="title"><strong> {{__('report.ticket_status')}} </strong></td>
            <td class="title"><strong> {{__('report.ticket_category')}} </strong></td>
            <td class="title"><strong> {{__('report.ticket_author_ip')}} </strong></td>
        </tr>
        <tr>
            <td>{{ $record->id }}</td>
            <td>{{ $record->status }}</td>
            <td>{{ $record->category->name }}</td>
            <td>{{ $record->author_ip }}</td>
        </tr>
    </table>    
    <br>

    <!-- Ticket content -->
    <table>
        <tr>
            <td class="title"><strong> {{ __('report.ticket_content')}} </strong></td>
        </tr>
        <tr>
            <td>  {!! $record->content !!} </td>
        </tr>
    </table> 

    <br>
    <!-- Ticket note -->
    <table>
        <tr>
            <td class="title"><strong> {{ __('report.ticket_note')}} </strong></td>
        </tr>
        <tr>
            <td>  {!! $record->note !!} </td>
        </tr>
    </table> 

    <br>
    <strong>{{ __('report.staff_name') }} : </strong>{{ isset($record->staff_id) ? $record->staff->name : '' }}
   

    

    
</div>

@endsection