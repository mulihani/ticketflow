<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class MonitorPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('monitor')
            ->path('monitor')
            ->brandName('Ticket Flow')
            ->brandLogo(asset('images/cpanel-logo.png'))
            ->darkModeBrandLogo(asset('images/cpanel-logo-dark.png'))
            ->brandLogoHeight('3rem')
            ->favicon(asset('images/favicon.ico'))
            ->colors([ 'primary' => Color::Amber, ])
            ->navigation(false)
            //->topbar(false)
            ->discoverResources(in: app_path('Filament/Monitor/Resources'), for: 'App\\Filament\\Monitor\\Resources')
            ->discoverPages(in: app_path('Filament/Monitor/Pages'), for: 'App\\Filament\\Monitor\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Monitor/Widgets'), for: 'App\\Filament\\Monitor\\Widgets')
            ->widgets([])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                //Authenticate::class,
            ]);
    }
}
