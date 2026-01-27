<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Classic Haircut',
                'price' => 75000,
                'duration' => 45,
                'emoji' => '✂️',
            ],
            [
                'name' => 'Premium Styling',
                'price' => 95000,
                'duration' => 60,
                'emoji' => '💈',
            ],
            [
                'name' => 'Beard Grooming',
                'price' => 50000,
                'duration' => 30,
                'emoji' => '🪒',
            ],
            [
                'name' => 'Hair Treatment',
                'price' => 85000,
                'duration' => 50,
                'emoji' => '✨',
            ],
            [
                'name' => 'Hair Coloring',
                'price' => 250000,
                'duration' => 120,
                'emoji' => '🎨',
            ],
            [
                'name' => 'Head Massage',
                'price' => 45000,
                'duration' => 25,
                'emoji' => '💆',
            ],
        ];

        DB::table('services')->insert($services);
    }
}
