<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barbers = [
            [
                'name' => 'Galih',
                'status' => 'Seniar Barber',
                'avatar' => '👨‍🦱',
            ],
            [
                'name' => 'Agus',
                'status' => 'Expert Barber',
                'avatar' => '👨',
            ],
            [
                'name' => 'Random',
                'status' => 'Barber Tersedia',
                'avatar' => '🎲',
            ],

        ];

        DB::table('barbers')->insert($barbers);
    }
}
