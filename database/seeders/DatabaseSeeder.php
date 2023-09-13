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
        User::factory()->count(10)->create();
        Category::factory()->count(10)->create();
        DeliveryAddress::factory()->count(10)->create();
        Product::factory()->count(10)->create();
        Order::factory()->count(10)->create();
        OrderLine::factory()->count(10)->create();
        ProductReview::factory()->count(10)->create();
    }
}
