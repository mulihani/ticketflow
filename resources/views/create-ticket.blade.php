@extends('layouts.app')

@section('title', 'Create Ticket')

@section('content')

@if ( App\Models\Setting::getSetting('users_only_status') && !auth()->check() )

    <div class="container px-4 py-4 shadow-sm bg-warning-subtle rounded">    
        <h3>
            {{ __('setting.users_only_status_message') }}
            <a href="login" class="btn  btn-success">{{ __('user.go_to_login_page') }}</a>
            {{ __('user.no_account') }}<a href="registration" class="btn btn-block btn-success">{{ __('user.create_one') }}</a>
        </h3>
    </div>

@else

    <div class="container col-xxl-8">

        @if (session('success'))
            <div class="p-4 my-4 shadow rounded bg-success-subtle">
                <div class="row">
                    <div class="col">
                        <h4 >
                            <i class="bi bi-check-circle-fill"></i>
                            {{ session('success') }}
                        </h4>
                    </div>
                    <div class="col-md-auto">
                        <form class="input-group" method="POST" action="{{ route('ticket.searsh') }}">
                            @csrf
                            <div class="col-auto px-2">
                                <input type="hidden" name="ticketID" class="form-control" id="ticketID" value="{{session('ticket_id')}}">
                            </div>
                            <div class="col-auto px-2">
                                <button type="submit" class="btn btn-success">{{ __('ticket.open_ticket') }} {{session('ticket_id')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif


        <div class="card shadow">

            <h5 class="card-header text-justify p-3">{{ __('ticket.request_form') }}</h5>

            <div class="card-body">
                @if (session('erorr'))
                    <div class="alert alert-danger text-justify" role="alert">
                        {{ session('erorr') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('ticket.store') }}" class="d-grid gap-3 p-4">
                    @csrf
                    <input type="text" name="user_id" value="{{ auth()->check() ? auth()->id() : '' }}" hidden>
                    <fieldset>
                        <legend class="fs-5">{{ __('ticket.customer_info') }}</legend>
                        <div class="row ">
                            <div class="col-md-3">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="author_id">
                                        <i class="bi bi-person-badge-fill"></i>
                                    </span>
                                    <input type="text" name="author_id" class="form-control"
                                        placeholder="{{ __('ticket.your_id') }}" aria-label="{{ __('ticket.your_id') }}" 
                                        aria-describedby="name" value="{{ auth()->check() ? auth()->user()->employee_id : old('author_id') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="name">{{ __('ticket.name') }}</span>
                                    <input type="text" name="name" class="form-control"
                                        placeholder="{{ __('ticket.your_name') }}" aria-label="{{ __('ticket.your_name') }}"
                                        aria-describedby="name" value="{{ auth()->check() ? auth()->user()->name : old('name')}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="mobile">
                                        <i class="bi bi-phone-fill"></i>
                                    </span>
                                    <input type="text" name="mobile" class="form-control"
                                        placeholder="{{ __('ticket.mobile_number') }}" aria-label="{{ __('ticket.mobile') }}"
                                        aria-describedby="mobile" value="{{auth()->check() ? auth()->user()->mobile : old('mobile')}}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="ext">
                                        <i class="bi bi-telephone-outbound-fill"></i>
                                    </span>
                                    <input type="text" name="ext" class="form-control"
                                        placeholder="{{ __('ticket.extension_number') }}" aria-label="{{ __('ticket.extension') }}"
                                        aria-describedby="ext" value="{{ auth()->check() ? auth()->user()->extension : old('ext') }}" required>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend class="fs-5">{{ __('ticket.issue_info') }}</legend>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="ip">{{ __('ticket.ip')}}</span>
                                    <input type="text" name="ip" class="form-control"
                                    placeholder="{{ __('ticket.ip_address') }}" aria-label="{{ __('ticket.ip_address') }}"
                                    aria-describedby="ip" value="{{Request::ip()}}" required>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="section">
                                        <i class="bi bi-building-fill"></i>
                                    </span>
                                    <select  name="section" class="form-select" aria-label="Select the section" required>
                                        <option selected disabled value="">{{ __('ticket.select_section')}}</option>
                                        @foreach ($sections as $section)
                                            <option value="{{$section->id}}" {{ auth()->id() ? ($section->id == auth()->user()->section_id ? 'selected' : '') : ''}}>
                                                {{$section->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="category">
                                        <i class="bi bi-exclamation-triangle-fill"></i>
                                    </span>
                                    <select  name="category" class="form-select" aria-label="Select the issue category" required>
                                        <option selected disabled value="">{{ __('ticket.select_category')}}</option>
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <label for="information" class="form-label fs-5">{{ __('ticket.additional_info') }}</label>
                            <textarea name="content" class="form-control" id="information" rows="3"
                            placeholder="{{ __('ticket.issue_description') }}" value="{{old('content')}}"></textarea>
                        </div>
                    </fieldset>

                    <div class="form-group row ">
                        <div class="col text-end">
                            <button type="submit" class="btn btn-success btn-lg px-4">{{ __('ticket.submit')}}</button>
                        </div>
                    </div>
    
                </form>
            </div>

        </div>
    </div>

@endif

@endsection
