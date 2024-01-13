<?php

namespace Tests\Unit;

use App\Services\ServiceOrder;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServiceOrderTest extends TestCase
{
    use RefreshDatabase;

    public function testOrderCreationWithValidDataCreatesOrder()
    {
        $user = User::factory()->create();
        $address = Address::factory()->create();
        $product = Product::factory()->create(['price' => 100]);

        $serviceOrder = new ServiceOrder();
        $request = new Request([
            'user' => json_encode(['id' => $user->id]),
            'order_lines' => json_encode([['product_id' => $product->id, 'quantity' => 2]]),
            'delivery_address' => json_encode(['id' => $address->id])
        ]);

        $response = $serviceOrder->createOrder($request);

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertDatabaseHas('orders', ['user_id' => $user->id, 'delivery_address_id' => $address->id]);
        $this->assertDatabaseHas('order_lines', ['order_id' => 1, 'product_id' => $product->id, 'quantity' => 2, 'price' => 200]);
    }

    public function testOrderCreationWithInvalidProductReturnsError()
    {
        $serviceOrder = new ServiceOrder();
        $request = new Request([
            'user' => json_encode(['id' => 1]),
            'order_lines' => json_encode([['product_id' => 999, 'quantity' => 2]]),
            'delivery_address' => json_encode(['id' => 1])
        ]);

        $response = $serviceOrder->createOrder($request);

        $this->assertEquals(500, $response->getStatusCode());
        $this->assertDatabaseMissing('orders', ['user_id' => 1, 'delivery_address_id' => 1]);
    }
}
