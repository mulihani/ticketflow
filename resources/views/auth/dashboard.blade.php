@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="container">

    <!-- Check if the user has not completed the profile data -->
    @if ( !$user->employee_id || !$user->mobile || !$user->extension)
        <div class="alert alert-warning shadow" role="alert">
            <i class="bi bi-exclamation-circle-fill"></i>  
            <strong>{{ __('dashboard.complete_your_profile')}}</strong>
            <a href="{{ route('profile') }}" class="btn btn-warning btn-sm">
                <i class="bi bi-person-circle"></i> {{ __('dashboard.update_profile') }}
            </a>
        </div>
    @endif

    <h4>{{ __('dashboard.dashboard') }}</h4>     

    <div class="row p-3">
        <div class="col-md-3 p-2">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h1>{{ userTicketCount() }}</h1>
                    <h5>{{ __('dashboard.all_ticket') }}</h5>
                    <img src="{{ asset('images/ticket-blue.png')}}" class="" alt="Tickets">
                </div>
            </div>
        </div>
        <div class="col-md-3 p-2">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h1>{{ userTicketCount('closed') }}</h1>
                    <h5>{{ __('dashboard.closed_ticket') }}</h5>
                    <img src="{{ asset('images/ticket-green.png')}}" class="" alt="Tickets">
                </div>
            </div>
        </div>
        <div class="col-md-3 p-2">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h1>{{ userTicketCount('processing') }}</h1>
                    <h5>{{ __('dashboard.processing_ticket') }}</h5>
                    <img src="{{ asset('images/ticket-outline.png')}}" class="" alt="Tickets">
                </div>
            </div>
        </div>
        <div class="col-md-3 p-2">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h1>{{ userTicketCount('open') }}</h1>
                    <h5>{{ __('dashboard.open_ticket') }}</h5>
                    <img src="{{ asset('images/ticket-red.png')}}" class="" alt="Tickets">
                </div>
            </div>
        </div>
    </div>

    <!-- The latest tickets added by the user -->
    <h4>{{ __('dashboard.last_tickets') }} [{{$tickets->count()}}]</h4>

    @if ( $tickets->count() == 0)

    <div class="row p-3">
        {{ __('dashboard.no_support_requests_added')}}
    </div>

    @else

    <div class="row p-3">
    @foreach($tickets as $ticket)
        <div class="col-md-4 p-2" >
            <form class="" method="POST" action="{{ route('ticket.searsh') }}">
            @csrf
            <div class="card shadow-sm " >
                <div class="card-header">
                    <i class="bi bi-check2-circle"></i> {{ __('dashboard.ticket_number') }} : {{ $ticket->id }}       
                    
                </div>
                <div class="card-body">
                    <i class="bi bi-clock"></i> {{ $ticket->created_at }} <br>
                    <strong>{{ __('dashboard.ticket_category') }}</strong> : {{ $ticket->category->name }} <br>
                    <strong>{{ __('dashboard.ticket_status') }}</strong> : {{ $ticket->status }} <br>

                        <div class="d-flex justify-content-end">
                            <input type="text" name="ticketID" class="form-control" id="ticketID" value="{{ $ticket->id }}" hidden>
                            <button type="submit" class="btn {{ $ticket->status == 'open' ? 'btn-danger' : ($ticket->status == 'processing' ? 'btn-warning' : 'btn-success')}}">
                                <i class="bi bi-zoom-in"></i> {{ __('dashboard.view_the_ticket') }}
                            </button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    @endforeach
    </div>

    @endif

</div>

@endsection