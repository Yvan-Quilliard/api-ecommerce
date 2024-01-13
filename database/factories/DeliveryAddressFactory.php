<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\DeliveryAddress;

class DeliveryAddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = DeliveryAddress::class;

    public function definition()
    {
        return [
            'recipient_name' => $this->faker->name,
            'recipient_phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'postal_code' => $this->faker->postcode,
            'city' => $this->faker->city,
            'country' => $this->faker->country,
//            'user_id' => $this->faker->unique()->numberBetween(1, 10),
        ];
    }
}
