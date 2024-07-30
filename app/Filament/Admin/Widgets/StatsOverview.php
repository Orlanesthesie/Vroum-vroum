<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Trip;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalUsers = User::count();
        $totalTrips = Trip::count();

        return [
            Stat::make('Utilisateurs', $totalUsers)
                ->description('Nombre total d\'utilisateurs')
            ->icon('heroicon-o-user')
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->color('success'),

            Stat::make('Trajets', $totalTrips)
                ->description('Nombre total de trajets')
            ->icon('heroicon-o-truck')
            ->color('danger')
        ];
    }
}
