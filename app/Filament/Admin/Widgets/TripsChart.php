<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Trip;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class TripsChart extends ChartWidget
{
    protected static ?int $sort = 3;
    // protected int | string | array $columnSpan = 'full';
    protected static ?string $heading = 'Statistiques des Trajets';

    protected function getData(): array
    {
        $tripsData = $this->getTripsData();
        $months = $this->getLast12Months();


        return [
            'labels' => array_map(fn ($month) => $month->format('Y-m'), $months),
            'datasets' => [
                [
                    'label' => 'Trajets',
                    'data' => array_values($tripsData),
                    'borderColor' => '#FF9800',
                    'backgroundColor' => 'rgba(255, 152, 0, 0.2)',
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    private function getTripsData(): array
    {
        $data = [];
        $months = $this->getLast12Months();

        foreach ($months as $month) {
            $data[$month->format('Y-m')] = Trip::whereYear('created_at', $month->year)
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
