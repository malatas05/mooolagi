<?php

namespace App\Filament\Widgets;

use App\Models\CustomRequest;
use App\Models\Product;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Pesanan Baru', CustomRequest::where('status', 'pending')->count())
                ->description('Menunggu ditinjau')
                ->descriptionIcon('heroicon-m-bell-alert')
                ->color('warning'),

            Stat::make('Pesanan Bulan Ini', CustomRequest::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count())
                ->description('Total request masuk')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('info'),

            Stat::make('Produk Aktif', Product::where('is_active', true)->count())
                ->description('Sedang ditampilkan di katalog')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('success'),

            Stat::make('Total Customer', User::role('customer')->count())
                ->description('Akun terdaftar')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),
        ];
    }
}