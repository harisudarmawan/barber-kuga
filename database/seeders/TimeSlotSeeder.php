<?php

namespace Database\Seeders;

use App\Models\TimeSlot;
use Illuminate\Database\Seeder;

class TimeSlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $slots = [
            ['start_time' => '09:00', 'end_time' => '10:00'],
            ['start_time' => '10:00', 'end_time' => '11:00'],
            ['start_time' => '11:00', 'end_time' => '12:00'],
            ['start_time' => '14:00', 'end_time' => '15:00'],
            ['start_time' => '15:00', 'end_time' => '16:00'],
            ['start_time' => '16:00', 'end_time' => '17:00'],
            ['start_time' => '17:00', 'end_time' => '18:00'],
            ['start_time' => '18:00', 'end_time' => '19:00'],
            ['start_time' => '19:00', 'end_time' => '20:00'],
        ];

        foreach ($slots as $slot) {
            TimeSlot::create($slot);
        }

    }
}
