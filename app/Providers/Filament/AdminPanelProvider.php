<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
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
            ->path('admin')
            ->login()
            ->brandName('Mooolagi Admin')
            ->brandLogo(asset('images/logo.png'))
            ->brandLogoHeight('2.5rem')
            ->favicon(asset('images/logo.png'))
            ->font('Plus Jakarta Sans')
            ->colors([
                'primary' => Color::hex('#1FA76B'),
                'success' => Color::hex('#1FA76B'),
                'warning' => Color::hex('#FFC72C'),
                'info' => Color::hex('#3E6FF2'),
                'danger' => Color::Rose,
                'gray' => Color::Gray,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
    Widgets\AccountWidget::class,
    \App\Filament\Widgets\DashboardStats::class,
    \App\Filament\Widgets\LatestCustomRequests::class,
])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->renderHook(
                \Filament\View\PanelsRenderHook::HEAD_END,
                fn (): string => <<<'HTML'
                    <style>
                        .fi-sidebar {
                            background-color: #F3FBF7;
                            border-right: 1px solid #DCEFE3;
                        }
                        .fi-sidebar-header {
                            border-bottom: 1px solid #DCEFE3;
                        }
                        .fi-sidebar-item-button:hover {
                            background-color: #E3F5EB;
                        }
                        .fi-sidebar-item-active .fi-sidebar-item-button {
                            background-color: #1FA76B;
                        }
                        .fi-sidebar-item-active .fi-sidebar-item-label,
                        .fi-sidebar-item-active .fi-sidebar-item-icon {
                            color: #FFFFFF;
                        }
                        .fi-topbar nav {
                            border-bottom: 1px solid #DCEFE3;
                        }
                        .fi-section {
                            border-radius: 1.25rem;
                        }
                        .fi-btn {
                            border-radius: 9999px;
                        }
                        .fi-input, .fi-select-input, .fi-textarea {
                            border-radius: 0.75rem;
                        }
                    </style>
                HTML
            )
            ->renderHook(
                \Filament\View\PanelsRenderHook::BODY_END,
                fn (): string => <<<'HTML'
                    <link rel="stylesheet" href="https://unpkg.com/photoswipe@5/dist/photoswipe.css">
                    <script type="module">
                        import PhotoSwipeLightbox from 'https://unpkg.com/photoswipe@5/dist/photoswipe-lightbox.esm.js';

                        function initAdminGallery() {
                            if (window.__moolagiAdminLightbox) {
                                window.__moolagiAdminLightbox.destroy();
                            }
                            const lightbox = new PhotoSwipeLightbox({
                                gallery: '.pswp-gallery-admin',
                                children: 'a',
                                wheelToZoom: true,
                                pswpModule: () => import('https://unpkg.com/photoswipe@5/dist/photoswipe.esm.js'),
                            });
                            lightbox.init();
                            window.__moolagiAdminLightbox = lightbox;
                        }

                        document.addEventListener('DOMContentLoaded', initAdminGallery);
                        document.addEventListener('livewire:navigated', initAdminGallery);
                    </script>
                HTML
            )
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}