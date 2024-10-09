@extends('layouts.app')

@section('title', 'Profile')

@section('content')

<div class="container col-xxl-6">
    <div class="card shadow">
        <h4 class="card-header text-justify p-3">{{ __('profile.profile') }}</h4>
        <div class="card-body px-5">
            <form action="{{route('profile.update')}}" method="post" enctype="multipart/form-data">
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
                    <div class="form-group py-2 col-md-6">
                        <label for="name" class="form-label fs-5"><i class="bi bi-person-fill"></i> {{ __('profile.name') }}</label>
                        <input type="text" name="name" class="form-control" value="{{$user->name}}">
                        <span class="text-danger">
                            @error('name')
                                {{$message}}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group py-2 col-md-6">
                        <label for="email" class="form-label fs-5"><i class="bi bi-envelope-fill"></i> {{ __('profile.email') }}</label>
                        <input type="email" name="email" class="form-control" value="{{$user->email}}">
                        <span class="text-danger">
                            @error('email')
                                {{$message}}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group py-2 col-md-6">
                        <label for="mobile" class="form-label fs-5"><i class="bi bi-phone-vibrate-fill"></i> {{ __('profile.mobile') }}</label>
                        <input type="mobile" name="mobile" class="form-control" value="{{$user->mobile}}">
                        <span class="text-danger">
                            @error('mobile')
                                {{$message}}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group py-2 col-md-6">
                        <label for="extension" class="form-label fs-5"><i class="bi bi-telephone-plus-fill"></i> {{ __('profile.extension') }}</label>
                        <input type="extension" name="extension" class="form-control" value="{{$user->extension}}">
                        <span class="text-danger">
                            @error('extension')
                                {{$message}}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group py-2 col-md-6">
                        <label for="employee_id" class="form-label fs-5"><i class="bi bi-person-vcard-fill"></i> {{ __('profile.employee_id') }}</label>
                        <input type="employee_id" name="employee_id" class="form-control" value="{{$user->employee_id}}">
                        <span class="text-danger">
                            @error('employee_id')
                                {{$message}}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group py-2 col-md-6">
                        <label for="section" class="form-label fs-5"><i class="bi bi-building-fill-add"></i> {{ __('profile.section') }}</label>

                        <select  name="section" class="form-select" aria-label="Select the section" required>
                            <option disabled value="">{{ __('ticket.select_section')}}</option>
                            @foreach ($sections as $section)
                                <option value="{{$section->id}}" {{ $section->id == auth()->user()->section_id ? 'selected' : '' }}>
                                    {{ $section->name }}
                                </option>
                            @endforeach
                        </select>
                        
                        <span class="text-danger">
                            @error('section')
                                {{$message}}
                            @enderror
                        </span>
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