<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\DeliveryAddress;
use App\Models\Order;
use App\Models\OrderLine;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->has(DeliveryAddress::factory(2))->create();

        Category::factory(3)->has(Product::factory(5))->create();

        Order::factory(10)->has(OrderLine::factory(5)->state(function () {
            return ['product_id' => Product::inRandomOrder()->first()->id];
        }))->create()->each(function ($order) {
            $order->user()->associate(User::inRandomOrder()->first())->save();
            $order->deliveryAddress()->associate(DeliveryAddress::inRandomOrder()->first())->save();
        });

        ProductReview::factory(10)->create();
    }
}
