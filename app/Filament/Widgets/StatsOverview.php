<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Pendapatan', 'IDR '.number_format(\App\Models\Booking::where('status', 'completed')->sum('total_price'), 0, ',', '.'))
                ->description('Total pendapatan dari booking selesai')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),

            Stat::make('Total Booking', \App\Models\Booking::count())
                ->description('Semua booking')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('primary'),

            Stat::make('Booking Menunggu', \App\Models\Booking::whereIn('status', ['waiting_payment', 'waiting_verification'])->count())
                ->description('Perlu tindakan')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make('Booking Hari Ini', \App\Models\Booking::whereDate('booking_date', now())->count())
                ->description('Booking untuk hari ini')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('info'),
        ];
    }
}
