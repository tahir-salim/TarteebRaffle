<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Receipt;

class ReceiptFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Receipt::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_id' => $this->faker->numberBetween(1, 10),
            'shop_id' => $this->faker->numberBetween(1, 10),
            'receipt_number' => $this->faker->numberBetween(1000,9999),
            'purchase_date' => $this->faker->dateTimeBetween('-10 days'),
            'amount' => $this->faker->randomFloat(0, 0, 9999.),
            'created_by_user_id' => $this->faker->numberBetween(1, 10),
            'created_at' => $this->faker->dateTimeBetween('-10 days'),
            'updated_at' => $this->faker->dateTimeBetween('-10 days'),
            'deleted_at' => null,
        ];
    }
}
