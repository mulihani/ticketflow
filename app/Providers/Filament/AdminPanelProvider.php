<?php

namespace App\Providers\Filament;

use App\Http\Middleware\Localization;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Navigation\NavigationItem;
use Filament\Navigation\MenuItem;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('cpanel')
            ->brandName('Ticket Flow')
            ->brandLogo(asset('images/cpanel-logo.png'))
            ->darkModeBrandLogo(asset('images/cpanel-logo-dark.png'))
            ->brandLogoHeight('2rem')
            ->favicon(asset('images/favicon.ico'))
            ->login()
            //->passwordReset() /* Email settings must be adjusted before activating this feature.*/
            ->font('Tahoma')
            ->colors([
                'primary' => Color::Amber,
            ])
            ->topNavigation()
            ->sidebarCollapsibleOnDesktop()
            ->profile()
            ->userMenuItems([
                'profile' => MenuItem::make()
                    ->label(fn () => __('user.edit_profile') ),
                'dashboard' =>  MenuItem::make()
                    ->label(fn () => __('user.dashboard') )
                    ->url('/cpanel')
                    ->icon('heroicon-o-home'),
                'staff' =>  MenuItem::make()
                    ->label(fn () => __('user.staff_dashboard') )
                    ->url('/staff')
                    ->icon('heroicon-o-users')
                    ->visible(fn () => auth()->user()->is_admin),
                'english' =>  MenuItem::make()
                    ->label(fn () => __('user.english_lang') )
                    ->url('/locale/en')
                    ->icon('heroicon-o-language'),
                'arabic' =>  MenuItem::make()
                    ->label(fn () => __('user.arabic_lang') )
                    ->url('/locale/ar')
                    ->icon('heroicon-o-language'),
            ])
            ->discoverResources(in: app_path('Filament/Admin/Resources'), for: 'App\\Filament\\Admin\\Resources')
            ->discoverPages(in: app_path('Filament/Admin/Pages'), for: 'App\\Filament\\Admin\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Admin/Widgets'), for: 'App\\Filament\\Admin\\Widgets')
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
                Localization::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugins([
                \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make()
            ])
            ->navigationItems([
                NavigationItem::make( fn () => __('setting.settings') )
                    ->url(fn (): string => Dashboard::getUrl().'/settings/1/edit')
                    ->icon('heroicon-m-cog-8-tooth')
                    ->sort(0),
            ])
            ;
    }

}
