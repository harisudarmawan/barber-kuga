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
                'description' => 'Potong rambut dengan teknik profesional + keramas + hair tonic + hot towel + styling',
                'emoji' => '✂️',
                'category_id' => 1,
            ],
            [
                'name' => 'Premium Styling',
                'price' => 95000,
                'duration' => 60,
                'description' => 'Potong rambut detail + konsultasi gaya + premium hair product + head massage',
                'emoji' => '💈',
                'category_id' => 1,

            ],
            [
                'name' => 'Beard Grooming',
                'price' => 50000,
                'duration' => 30,
                'description' => 'Perawatan jenggot & kumis + razor shave + premium beard oil application',
                'emoji' => '🪒',
                'category_id' => 1,

            ],
            [
                'name' => 'Hair Treatment',
                'price' => 85000,
                'duration' => 50,
                'description' => 'Hair mask premium untuk kesehatan akar rambut, ketombe, dan rambut rontok',
                'emoji' => '✨',
                'category_id' => 2,
            ],
            [
                'name' => 'Hair Coloring',
                'price' => 250000,
                'duration' => 120,
                'description' => 'Pewarnaan rambut profesional (Natural, Fashion, or Bold Cover)',
                'emoji' => '🎨',
                'category_id' => 2,

            ],
            [
                'name' => 'Head Massage',
                'price' => 45000,
                'duration' => 25,
                'description' => 'Pijat kepala, leher, dan bahu intensif untuk relaksasi total',
                'emoji' => '💆',
                'category_id' => 2,

            ],
        ];

        DB::table('services')->insert($services);
    }
}
