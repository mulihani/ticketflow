@extends('layouts.app')

@section('title', 'Login')

@section('content')

<div class="container col-xxl-6">
    <div class="card shadow">
            <h4 class="card-header text-justify p-3">{{ __('user.login_form_title') }}</h4>
            <div class="card-body p-5">
                <form action="{{route('executeLogin')}}" method="post" enctype="multipart/form-data">
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

                    <div class="form-group">
                        <label for="email" class="form-label fs-5"><i class="bi bi-envelope-fill"></i> {{ __('user.email') }}</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                        <span class="text-danger">
                            @error('email')
                                {{$message}}
                            @enderror
                        </span>
                    </div>
                    <br>
                    <div class="form-group">
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
                        <button type="submit" class="btn btn-block btn-success">{{ __('user.login_button') }}</button> 
                    </div>
                    <br>
                    {{ __('user.no_account') }}<a href="registration">{{ __('user.create_one') }}</a>
                </form>
            </div>
    </div>
</div>

@endsection