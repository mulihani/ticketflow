@extends('layouts.app')

@section('title', 'Home')

@section('content')

<!--  Check if the ticket search feature is active (status On/Off) -->
@if(App\Models\Setting::getSetting('ticket_search_status'))
    <div class="container px-4 py-4 shadow-sm bg-warning-subtle rounded">
        @if (session('erorr') || $errors->any())
            <div class="alert alert-danger text-justify shadow" role="alert">
                {{ session('erorr')}}

                @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif

            </div>
        @endif

        <form class="input-group" method="POST" action="{{ route('ticket.searsh') }}">
            @csrf
            <div class="col px-2">
                <label for="ticketID" class="fs-5">{{ __('index.check_previous_message') }}</label>
            </div>
            <div class="col-auto px-2">
                <input type="text" name="ticketID" class="form-control" id="ticketID" placeholder="{{ __('index.ticket_number') }}" required>
            </div>
            <div class="col-auto px-2">
                <button type="submit" class="btn btn-outline-secondary">{{ __('index.search') }}</button>
            </div>
        </form>

    </div>
@endif

<div class="container py-3 ">
    <div class="row flex-lg-row-reverse align-items-center   px-4 shadow bg-success-subtle rounded border ">
        <div class="col-lg-6">
            <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">{{ __('index.content_title') }}</h1>
            <p class="lead">
            {{ __('index.content') }}
            </p>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                <a href="{{ route('ticket.create') }}" class="btn btn-success btn-lg px-4 me-md-2">{{ __('index.request_support') }}</a>
            </div>
        </div>
        <div class="col-10 col-sm-8 col-lg-6 justify-content-end">
            <img src="{{asset('images\Customer-Support-Tickets.webp')}}"
            class="d-block mx-lg-auto img-fluid" alt="Tecket Flow" width="700" height="500" loading="lazy">
        </div>
    </div>
</div>

@endsection
