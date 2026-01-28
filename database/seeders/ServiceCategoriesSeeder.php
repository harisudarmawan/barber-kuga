<?php

namespace Database\Seeders;

use App\Models\ServiceCategories;
use Illuminate\Database\Seeder;

class ServiceCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ServiceCategories::create([
            'name' => 'General Cut',
        ]);
        ServiceCategories::create([
            'name' => 'Specialist Treatment',
        ]);
    }
}
