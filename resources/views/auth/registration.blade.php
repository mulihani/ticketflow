@extends('layouts.app')

@section('title', 'Registration')

@section('content')

<div class="container col-xxl-6">
    
@if ( ! App\Models\Setting::getSetting('signup_status') )

    <div class="container px-4 py-4 shadow-sm bg-warning-subtle rounded">    
        <h3>{{ __('setting.registration_closed_message') }}</h3>
    </div>

@else

    <div class="card shadow">

        <h3 class="card-header text-justify p-3">{{ __('user.registration') }}</h3>
        <div class="card-body p-5">

            <form action="{{route('register')}}" method="post" enctype="multipart/form-data">
                @csrf

                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{Session::get('success')}}
                    </div>
                @endif
                
                @if (Session::has('fail'))
                <div class="alert alert-danger">
                    {{Session::get('fail')}}
                </div>
                @endif

                <div class="form-group py-2">
                    <label for="name" class="form-label fs-5"><i class="bi bi-person-fill"></i> {{ __('user.name') }}</label>
                    <input type="text" name="name" class="form-control" value="{{old('name')}}">
                    <span class="text-danger">
                        @error('name')
                            {{$message}}
                        @enderror
                    </span>
                </div>
                <div class="form-group py-2">
                    <label for="email" class="form-label fs-5"><i class="bi bi-envelope-fill"></i> {{ __('user.email') }}</label>
                    <input type="email" name="email" class="form-control" value="{{old('email')}}">
                    <span class="text-danger">
                        @error('email')
                            {{$message}}
                        @enderror
                    </span>
                </div>
                <div class="form-group py-2">
                    <label for="password" class="form-label fs-5"><i class="bi bi-lock-fill"></i> {{ __('user.password') }}</label>
                    <input type="password" name="password" class="form-control">
                    <span class="text-danger">
                        @error('password')
                            {{$message}}
                        @enderror
                    </span>
                </div>

                <br>
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-success">{{__('user.registr')}}</button>                        
                </div>
                <br>
                {{ __('user.already_have_account') }}<a href="login">{{ __('user.go_to_login_page') }}</a>
            </form>
        </div>
    </div>

@endif

</div>

@endsection