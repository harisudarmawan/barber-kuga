<?php

namespace App\Filament\Resources\TimeSlots\Schemas;

use Filament\Schemas\Schema;

class TimeSlotForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\TimePicker::make('start_time')
                    ->required()
                    ->seconds(false),
                \Filament\Forms\Components\TimePicker::make('end_time')
                    ->required()
                    ->seconds(false),
                \Filament\Forms\Components\Toggle::make('is_active')
                    ->required()
                    ->default(true),
            ]);
    }
}
