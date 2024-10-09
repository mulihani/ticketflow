@extends('layouts.app')

@section('title', 'Show Ticket')

@section('content')

    @php
        if($ticket->status == 'closed'){
            $img_name = 'images/ticket-info.png';
            $bg_color = 'bg-success-subtle';
        }
        elseif ($ticket->status == 'processing') {
            $img_name = 'images/ticket-processing.png';
            $bg_color = 'bg-warning-subtle';
        }
        else{
            $img_name = 'images\ticket-danger.png';
            $bg_color = 'bg-danger-subtle';
        }
    @endphp


    <div class="container col-xxl-8 px-4 py-5 ">
        @if (session('success'))
            <div class="alert alert-success text-justify py-5 shadow rounded fs-4" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="row flex-lg-row-reverse align-items-center g-5 py-4 px-4 shadow rounded {{$bg_color}}">

            <div class="col-10 col-sm-8 col-lg-5 text-center">
                <h1 class="display-5 fw-bold mb-3">{{ __('ticket.ticket_number') }} : {{ $ticket->id }}</h1>
                <img src="{{asset($img_name)}}" class="d-block mx-lg-auto img-fluid" alt="Ticket info" width="60%" loading="lazy">
                <h1 class="display-5 fw-bold mb-3">
                    {{ __('ticket.ticket_status') }}
                    @if ($ticket->status == 'open')
                        {{ __('ticket.open') }}
                    @elseif ($ticket->status == 'processing')
                        {{ __('ticket.processing') }}
                    @else
                    {{ __('ticket.closed') }}
                    @endif
                </h1>
            </div>
            <div class="col-lg-7">
                <fieldset>
                    <legend>{{ __('ticket.ticket_customer_info') }}</legend><hr>
                    <div class="p-3 m-3">
                        <p>
                            <i class="bi bi-person-fill"></i> &nbsp;&nbsp;
                            {{ $ticket->author_name }}
                            <br />
                            <i class="bi bi-telephone-fill"></i> &nbsp;&nbsp;
                            {{ $ticket->author_ext }}
                            <br />
                            <i class="bi bi-calendar-event-fill"></i> &nbsp;&nbsp;
                            {{ $ticket->created_at }}
                        </p>
                    </div>
                </fieldset>

                <fieldset>
                    <legend>{{ __('ticket.ticket_issue') }}</legend><hr>
                        <dl class="row p-3 m-3">
                            <dt class="col-sm-3">{{ __('ticket.ticket_ip') }}</dt>
                            <dd class="col-sm-9">{{ $ticket->author_ip }} </dd>
                            <dt class="col-sm-3">{{ __('ticket.ticket_section') }}</dt>
                            <dd class="col-sm-9">{{ App\Models\Section::getSection($ticket->section_id) }}</dd>
                            <dt class="col-sm-3">{{ __('ticket.ticket_category') }}</dt>
                            <dd class="col-sm-9">{{ App\Models\Category::getCategory($ticket->category_id) }}</dd>
                            <dt class="col-sm-3">{{ __('ticket.ticket_issue') }}</dt>
                            <dd class="col-sm-9">{!! $ticket->content !!}</dd>
                        </dl>
                </fieldset>

                <fieldset>
                    <legend>{{ __('ticket.ticket_notes') }}</legend><hr>
                    <div class="row p-3 m-3">
                        {!! $ticket->note !!}
                    </div>
                </fieldset>

            </div>
        </div>
    </div>


@endsection
