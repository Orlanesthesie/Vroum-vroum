<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\User;
use App\Models\Trip;
use Carbon\Carbon;

class UsersChart extends ChartWidget
{
    protected static ?int $sort = 3;
    // protected int | string | array $columnSpan = 'full';
    protected static ?string $heading = 'Statistiques des Utilisateurs et Trajets';

    protected function getData(): array
    {
        $usersData = $this->getUsersData();
        $months = $this->getLast12Months();

        return [
            'labels' => array_map(fn ($month) => $month->format('Y-m'), $months),
            'datasets' => [
                [
                    'label' => 'Utilisateurs',
                    'data' => array_values($usersData),
                    'borderColor' => '#4CAF50',
                    'backgroundColor' => 'rgba(76, 175, 80, 0.2)',
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    private function getUsersData(): array
    {
        $data = [];
        $months = $this->getLast12Months();

        foreach ($months as $month) {
            $data[$month->format('Y-m')] = User::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        }

        return $data;
    }

    private function getLast12Months(): array
    {
        $months = [];
        for ($i = 11; $i >= 0; $i--) {
            $months[] = Carbon::now()->subMonths($i);
        }

        return $months;
    }
}
