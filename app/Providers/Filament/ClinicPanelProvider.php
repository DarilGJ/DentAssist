<?php

namespace App\Providers\Filament;

// use App\Filament\Clinic\Widgets\CalendarAppointmentWidget;
use App\Filament\Resources\AppointmentResource;
use App\Filament\Resources\PatientResource;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Saade\FilamentFullCalendar\FilamentFullCalendarPlugin;

class ClinicPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('clinic')
            ->path('clinic')
            ->colors([
                'primary' => Color::Green,
            ])

            ->favicon('/images/dentassist-logo.png')
            ->brandLogo('/images/dentassist-logo.png')
            ->brandLogoHeight('4rem')

            ->discoverResources(in: app_path('Filament/Clinic/Resources'), for: 'App\\Filament\\Clinic\\Resources')
            ->discoverPages(in: app_path('Filament/Clinic/Pages'), for: 'App\\Filament\\Clinic\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Clinic/Widgets'), for: 'App\\Filament\\Clinic\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
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
                Authenticate::class,
            ])
            ->resources([
                PatientResource::class,
                AppointmentResource::class,
            ])
            ->plugins([
                FilamentFullCalendarPlugin::make()->locale('es'),
            ]);
    }
}
