<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Trip;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        $totalUsers = User::count();
        $totalTrips = Trip::count();
        $totalAdmins = User::where('role', 'admin')->count();

        return [
            Stat::make('Trajets', $totalTrips)
                ->description('Nombre total de trajets')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->icon('heroicon-o-truck')
                ->chart([7, 12, 4, 12, 9, 17])
                ->color('warning'),

            Stat::make('Admin', $totalAdmins)
                ->description('Nombre total d\'admin')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->icon('heroicon-o-user')
                ->color('danger'),

            Stat::make('Utilisateurs', $totalUsers)
                ->description('Nombre total d\'utilisateurs')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->icon('heroicon-o-user')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            
        ];
    }
}
