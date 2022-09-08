<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = $this->faker->sentence(rand(3,7));
        $user_id = [1,2,3];
        return [
            'title'=>$title,
            'desc'=>$this->faker->text(100),
            'user_id'=>$user_id[rand(0,2)],

        ];
    }
}
