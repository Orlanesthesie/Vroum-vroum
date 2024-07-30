<?php

namespace App\Filament\Admin\Widgets;

use App\Models\User;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestUsers extends BaseWidget
{
    protected static ?int $sort = 4;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                User::latest()->limit(10)
            )
            ->columns([
                TextColumn::make('id')->label('ID'),
                TextColumn::make('lastname')->label('Nom'),
                TextColumn::make('firstname')->label('Prénom'),
                TextColumn::make('email')->label('Email'),
                TextColumn::make('password')->label('Mot de passe'),
                TextColumn::make('role')->label('Role'),
                TextColumn::make('avatar')->label('Avatar'),
            ]);
    }
}
