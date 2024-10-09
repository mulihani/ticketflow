@extends('layouts.app')

@section('title', 'Update password')

@section('content')

<div class="container col-xxl-6">
    <div class="card shadow ">
        <h4 class="card-header text-justify p-3">{{ __('profile.update_password') }}</h4>
        <div class="card-body px-5">
            <form action="{{route('password.update')}}" method="post" enctype="multipart/form-data">
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

                <div class="row ">
                    <div class=" py-2 col-md-6">
                        <div class="form-group ">
                            <label for="current_password" class="form-label fs-5"><i class="bi bi-shield-lock"></i> {{ __('profile.current_password') }}</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" required>
                            <span class="text-danger">
                                @error('current_password')
                                    {{$message}}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group py-2 ">
                            <label for="new_password" class="form-label fs-5"><i class="bi bi-shield-plus"></i></i> {{ __('profile.new_password') }}</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                            <span class="text-danger">
                                @error('new_password')
                                    {{$message}}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group py-2 ">
                            <label for="new_password_confirmation" class="form-label fs-5"><i class="bi bi-shield-check"></i> {{ __('profile.confirm_password') }}</label>
                            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                            <span class="text-danger">
                                @error('confirm_password')
                                    {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class=" py-2 col-md-6 text-center">
                        <img src="{{asset('images/password-update.png')}}" width="" height="300px" alt="Tickt Flow">
                    </div>
                </div>
                            
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-success ">{{__('profile.update')}}</button>                        
                </div>
            </form>
        </div>
    </div>
</div>

@endsection