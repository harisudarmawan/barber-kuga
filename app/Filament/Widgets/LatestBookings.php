<?php

namespace App\Filament\Widgets;

use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestBookings extends TableWidget
{
    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                fn (): Builder => \App\Models\Booking::query()->latest()
            )
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('booking_code')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->label('Kode'),
                \Filament\Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Pelanggan'),
                \Filament\Tables\Columns\TextColumn::make('service.name')
                    ->label('Layanan')
                    ->limit(20),
                \Filament\Tables\Columns\TextColumn::make('booking_date')
                    ->date()
                    ->sortable()
                    ->label('Tanggal'),
                \Filament\Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'waiting_payment' => 'warning',
                        'waiting_verification' => 'info',
                        'confirmed' => 'success',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => ucfirst(str_replace('_', ' ', $state))),
                \Filament\Tables\Columns\TextColumn::make('total_price')
                    ->money('IDR')
                    ->sortable()
                    ->label('Harga'),
            ]);
        // ->paginated(false)
        // ->limit(5);
    }
}
