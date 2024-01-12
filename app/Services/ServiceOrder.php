<?php

namespace App\Services;

use App\Interfaces\OrderInterface;
use App\Models\Order;
use Illuminate\Http\Request;

class ServiceOrder implements OrderInterface
{

    public function createOrder(Request $request)
    {

        $user = json_decode($request->user);
        $orderLines = $request->order_lines;

        $order = Order::create([
            'user_id' => $user->id,
            'order_date' => now(),
            'status' => 'En cours',
        ]);


        $orderId = $order->id;

        return response()->json([
            'success' => true,
            'message' => 'Order created successfully',
            'data' => ['orderLines' => $orderLines, 'user_id' => $user->id, 'order_id' => $orderId]
        ], 201);
    }
}
