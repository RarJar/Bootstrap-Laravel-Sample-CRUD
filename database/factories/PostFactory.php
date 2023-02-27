<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $address=['yangon','bago','mandalay','pyin oo lwin','kyaiklat','Mubin','Pathein'];

        return [
            'title'=>$this->faker->sentence(2),
            'description'=>$this->faker->text(500),
            'price'=>rand(2000,5000),
            'address'=>$address[array_rand($address)],
            'rating'=>rand(0,5)
        ];
    }
}
