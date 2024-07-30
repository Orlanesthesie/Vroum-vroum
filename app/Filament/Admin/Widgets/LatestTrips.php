<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Trip;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestTrips extends BaseWidget
{
    protected static ?int $sort = 5;
    protected int | string | array $columnSpan = 'full';
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Trip::latest()->limit(10)
            )
            ->columns([
                TextColumn::make('id')->label('ID'),
                TextColumn::make('starting_point')->label('Point de départ'),
                TextColumn::make('ending_point')->label('Point d\'arrivée'),
                TextColumn::make('starting_at')->label('Départ')->dateTime(),
                TextColumn::make('available_places')->label('Places disponibles'),
                TextColumn::make('price')->label('Prix'),
                TextColumn::make('user.name')->label('Utilisateur'),
            ]);
    }
}
