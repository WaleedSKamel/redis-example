<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{

    /**
     * @throws \Exception
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(2),
            'active'=> random_int(0,1),
        ];
    }
}
