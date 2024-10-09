<!doctype html>
<html dir="{{(App::isLocale('ar') ? 'rtl' : 'ltr')}}" lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="auto">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">

    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap.rtl.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap-icons.min.css')}}" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{asset('images/favicon.ico')}}">

    <title>{{App\Models\Setting::getSetting('site_name')}} - @yield('title')</title>

</head>
<body>
    <div >

        <!-- Header -->
        @includeIf('layouts.header')

        <!-- Grid -->
        <div class="container-fluid py-5">

            <!--  Check if the site is active (status On/Off) -->
            @if ( siteIsActive() )

                @if ( isSiteClosedToday() )

                    <div class="container col-xxl-8 px-4 py-5 ">
                        <h4 class="p-4 my-4 shadow-sm rounded bg-success-subtle">
                        {!! App\Models\Setting::getSetting('site_activation_hours_massage') !!}
                        </h4>
                    </div>

                <!-- Check if the site runs according to a specific hour (site_activation_hours On/Off) -->
                @elseif ( siteActivationHours() )

                    <!-- Content -->
                    @yield('content')

                @else
                    <div class="container col-xxl-8 px-4 py-5 ">
                        <h4 class="p-4 my-4 shadow-sm rounded bg-success-subtle">
                        {!! App\Models\Setting::getSetting('site_activation_hours_massage') !!}
                        </h4>
                    </div>
                @endif

            <!-- if the site status is Off -->
            @else
                <div class="container col-xxl-8 px-4 py-5 ">
                    <h4 class="p-4 my-4 shadow-sm rounded bg-success-subtle">
                        {!! App\Models\Setting::getSetting('site_close_massage') !!}
                    </h4>
                </div>
            @endif

            <!-- Footer -->
            @includeIf('layouts.footer')
        </div>

    </div>

    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>

</body>

</html>
