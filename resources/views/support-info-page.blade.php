@extends('layouts.app')

@section('title', 'Support Information')

@section('content')

    <!--  Check if the support info page is active (status On/Off) -->
    @if(App\Models\Setting::getSetting('support_info_page_status'))

    <div class="container col-xxl-8 px-4 py-2 ">
        <div class="row py-4 px-4">
            {!! App\Models\Setting::getSetting('support_info_page') !!}
        </div>
    </div>

    @endif
@endsection
