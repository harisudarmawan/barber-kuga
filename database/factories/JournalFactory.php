<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Journal>
 */
class JournalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(6),
            'image' => 'test/gallery1.jpg',
            'summary' => $this->faker->paragraph(2),
            'content' => '
                <div>
                    <h2>'.$this->faker->sentence(4).'</h2>

                    <p>'.$this->faker->paragraph(3).'</p>

                    <p><strong>'.$this->faker->sentence(5).'</strong></p>

                    <ul>
                        <li>'.$this->faker->sentence().'</li>
                        <li>'.$this->faker->sentence().'</li>
                        <li>'.$this->faker->sentence().'</li>
                    </ul>

                    <p>'.$this->faker->paragraph(2).'</p>
                </div>
            ',
        ];
    }
}
