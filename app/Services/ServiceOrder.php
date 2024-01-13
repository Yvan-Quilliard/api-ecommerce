<?php

namespace App\Services;

use App\Interfaces\OrderInterface;
use App\Models\Order;
use App\Models\OrderLine;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ServiceOrder implements OrderInterface
{

    public function createOrder(Request $request)
    {

        $user = json_decode($request->user);
        $orderLines = json_decode($request->order_lines);
        $deliveryAddress = json_decode($request->delivery_address);

        $order = Order::create([
            'user_id' => $user->id,
            'delivery_address_id' => $deliveryAddress->id,
            'order_date' => now(),
            'status' => 'pending',
        ]);


        foreach ($orderLines as $orderLine) {

            $product = $this->getProduct($orderLine->product_id);
            $quantity = $orderLine->quantity;
            $price = $product->price * $quantity;

            OrderLine::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $orderLine->quantity,
                'price' => $price
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Order created successfully',
            'data' => $order
        ], 201);
    }

    private function getProduct($id)
    {

        try {
            $product = Product::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return false;
        }

        return $product;
    }

}
