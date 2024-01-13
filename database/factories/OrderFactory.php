<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Order::class;

    public function definition()
    {
        return [
//            'user_id' => $this->faker->numberBetween(1, 3),
            'order_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
//            'delivery_address_id' => $this->faker->numberBetween(1, 3),
            'status' => $this->faker->randomElement(['pending', 'processing', 'completed', 'declined', 'cancelled'])
        ];
    }
}
