<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $packages = [
            [
                'name' => 'Basic Package',
                'price' => 150000,
                'features' => [
                    'Classic Haircut',
                    'Hair Wash & Tonic',
                    'Hot Towel Treatment',
                    'Basic Styling',
                    'Complimentary Coffee'
                ],
                'is_popular' => false,
                'sort_order' => 1,
                'period' => 'Per Kunjungan',
            ],
            [
                'name' => 'Premium Package',
                'price' => 275000,
                'features' => [
                    'Premium Haircut & Styling',
                    'Beard Grooming',
                    'Hair Treatment',
                    'Head Massage (15 menit)',
                    'Premium Hair Products',
                    'Complimentary Beverage'
                ],
                'is_popular' => true,
                'sort_order' => 2,
                'period' => 'Per Kunjungan',
            ],
            [
                'name' => 'Ultimate Package',
                'price' => 450000,
                'features' => [
                    'Luxury Haircut & Styling',
                    'Complete Beard Care',
                    'Hair Coloring/Treatment',
                    'Full Body Massage (30 menit)',
                    'Facial Treatment',
                    'Take Home Products',
                    'Priority Booking'
                ],
                'is_popular' => false,
                'sort_order' => 3,
                'period' => 'Per Kunjungan',
            ],
        ];

        foreach ($packages as $package) {
            \App\Models\SpecialPackage::create($package);
        }
    }
}
