<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RaffleEntryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_id' => $this->faker->numberBetween(1, 100),
            'raffle_id' => $this->faker->numberBetween(1, 100),
            'total_amount' => $this->faker->numberBetween(100, 9999),
            'number_of_entries'=>$this->faker->numberBetween(1, 100),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
            'deleted_at' => null,
        ];
    }
}
