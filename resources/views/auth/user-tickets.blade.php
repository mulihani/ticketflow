@extends('layouts.app')

@section('title', 'My tickets')

@section('content')

<div class="container mt-4">
        <h3 class="mb-4">
            <i class="bi bi-stickies"></i> 
            {{ __('ticket.your_tickets_total') }} [ {{ userTicketCount() }} ]
        </h3>

        @if($tickets->count())

            <p class="">
                {{ __('pagination.showing') }}
                <span class="fw-semibold"> {{ $tickets->firstItem() }} </span>
                {{ __('pagination.to') }}
                <span class="fw-semibold"> {{ $tickets->lastItem() }} </span>
                {{ __('pagination.of') }}
                <span class="fw-semibold"> {{ $tickets->total() }} </span>
                {{ __('pagination.results') }}
            </p>

            <table class="table table-hover table-sm table-responsive shadow">
                <thead class="table-dark">
                    <tr>
                        <th class="px-3 text-center">{{ __('ticket.ticket_number') }}</th>
                        <th>{{ __('ticket.ticket_created_at') }}</th>
                        <th>{{ __('ticket.ticket_status') }}</th>
                        <th>{{ __('ticket.ticket_category') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $ticket)
                        <tr class="{{ $ticket->status == 'open' ? 'table-danger' : ($ticket->status == 'processing' ? 'table-warning' : '')}}">
                            <td class="col-md-2 px-3 text-center">{{ $ticket->id }}</td>
                            <td>{{ $ticket->created_at->format('d M Y, H:i') }}</td>
                            <td>{{ $ticket->status }}</td>
                            <td>{{ $ticket->category->name }}</td>
                            <td class="col-md-1 px-3 text-center">
                                <form class="" method="POST" action="{{ route('ticket.searsh') }}">
                                @csrf
                                    <input type="text" name="ticketID" class="form-control" id="ticketID" value="{{ $ticket->id }}" hidden>
                                    <button type="submit" class="btn btn-outline-secondary btn-sm"><i class="bi bi-zoom-in"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination Links -->
            <div class="pagination justify-content-center p-2">
                {{ $tickets->links('pagination::simple-bootstrap-5') }} 
            </div>

        @else
            <p>No tickets found.</p>
        @endif
    </div>

@endsection