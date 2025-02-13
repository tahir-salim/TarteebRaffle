<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Customer;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'cpr' => $this->faker->numberBetween(01010000, 99129999),
            'phone' => $this->faker->numberBetween(10000000, 99999999),
            'email' => $this->faker->safeEmail,
            'country_id' => $this->faker->numberBetween(1, 245),
        ];
    }
}
