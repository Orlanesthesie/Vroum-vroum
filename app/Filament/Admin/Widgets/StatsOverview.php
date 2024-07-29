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
            Stat::make('Total Utilisateurs', $totalUsers)
                ->description('Nombre total d\'utilisateurs')
                ->icon('heroicon-o-user'),

            Stat::make('Total Trajets', $totalTrips)
                ->description('Nombre total de trajets')
                ->icon('heroicon-o-truck'),
        ];
    }
}
