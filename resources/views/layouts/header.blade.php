<header class="py-3 mb-4 shadow-sm bg-body-tertiary" >
    <div dir="" class="container d-flex flex-wrap justify-content-between align-items-center">
        <a href="{{ route('index') }}" class=" text-decoration-none">
            <img src="{{asset('images/logo.png')}}" width="" height="50px" alt="Tickt Flow">
        </a>

        <span class="fs-4 p-3">
            <i class="bi bi-telephone-inbound-fill"></i>
            &nbsp;{{ __('header.it_contact') }} {{App\Models\Setting::getSetting('it_support_number')}}
        </span>

        <!-- Check the site status -->
        @if ( siteIsActive() && !isSiteClosedToday() && siteActivationHours() )
            <div class="align-items-center">

                <a href="{{ route('index') }}" class="btn btn-outline-secondary btn-md">
                    <i class="bi bi-house-door-fill"></i>
                </a>

                @if (!auth()->check())
                <a href="{{ route('login') }}" class="btn btn-outline-secondary  btn-md"><i class="bi bi-box-arrow-in-left"></i> {{ __('header.login') }}</a>
                @endif

                <!--  Check if the support info page is active (status On/Off) -->
                @if(App\Models\Setting::getSetting('support_info_page_status'))
                <a href="{{ route('info') }}" class="btn btn-outline-secondary  btn-md"><strong>&nbsp; {{ __('header.it_department') }} &nbsp;</strong></a>
                @endif

                <a href="{{ route('ticket.create') }}" class="btn btn-outline-secondary  btn-md"><i class="bi bi-person-fill-gear"></i> {{ __('header.request_button') }}</a>

                @if (auth()->check())
                <div class="btn-group dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i>
                    </button>
                    <ul class="dropdown-menu text-end">
                        <li class="dropdown-header">{{ auth()->user()->name }}</li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a href="{{ route('dashboard') }}" class="dropdown-item"><i class="bi bi-gear-fill"></i> {{ __('header.dashboard') }}</a></li>
                        <li><a href="{{ route('user.tickets') }}" class="dropdown-item"><i class="bi bi-ticket-detailed-fill"></i> {{ __('header.user_tickets') }}</a></li>
                        <li><a href="{{ route('profile') }}" class="dropdown-item"><i class="bi bi-person-circle"></i> {{ __('header.profile') }}</a></li>
                        <li><a href="{{ route('password') }}" class="dropdown-item"><i class="bi bi-key-fill"></i> {{ __('header.update_password') }}</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}" ><i class="bi bi-power"></i> {{ __('header.logout') }}</a></li>
                    </ul>
                </div>            
                @endif

                @if (app()->getLocale() == 'en')
                    <a href="{{ route('set.locale','ar') }}" class="btn btn-outline-secondary btn-md"><i class="bi bi-translate"></i> {{ __('header.lang') }}</a>
                @elseif (app()->getLocale() == 'ar')
                    <a href="{{ route('set.locale','en') }}" class="btn btn-outline-secondary btn-md"><i class="bi bi-translate"></i> {{ __('header.lang') }}</a>
                @endif

            </div>
        @endif
    </div>
</header>
