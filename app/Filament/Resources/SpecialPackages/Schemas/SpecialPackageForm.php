<?php

namespace App\Filament\Resources\SpecialPackages\Schemas;

use Filament\Schemas\Schema;

use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class SpecialPackageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Paket')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Contoh: Basic Package')
                    ->helperText('Nama paket yang akan ditampilkan di halaman depan.'),
                TextInput::make('price')
                    ->label('Harga')
                    ->required()
                    ->numeric()
                    ->prefix('Rp')
                    ->placeholder('150000')
                    ->helperText('Masukkan harga tanpa titik atau koma.'),
                TagsInput::make('features')
                    ->label('Fitur Paket')
                    ->required()
                    ->columnSpanFull()
                    ->placeholder('Tambah fitur...')
                    ->helperText('Ketik nama fitur lalu tekan Enter untuk menambahkan. Contoh: Haircut, Massage.'),
                TextInput::make('period')
                    ->label('Periode')
                    ->required()
                    ->default('Per Kunjungan')
                    ->placeholder('Contoh: Per Kunjungan')
                    ->helperText('Keterangan durasi atau frekuensi paket.'),
                TextInput::make('sort_order')
                    ->label('Urutan')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->helperText('Urutan tampilan paket. Angka lebih kecil akan tampil lebih dulu.'),
                Toggle::make('is_popular')
                    ->label('Most Popular')
                    ->required()
                    ->helperText('Aktifkan jika ini adalah paket unggulan (akan diberi highlight/lencana).'),
            ]);
    }
}
