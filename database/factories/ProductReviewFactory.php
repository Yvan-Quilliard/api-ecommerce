<?php

namespace Database\Factories;

use App\Models\ProductReview;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = ProductReview::class;

    public function definition()
    {
        return [
//            'product_id' => $this->faker->numberBetween(1, 10),
//            'user_id' => $this->faker->numberBetween(1, 10),
            'comment' => $this->faker->paragraph(3),
            'rating' => $this->faker->numberBetween(1, 5)
        ];
    }
}
