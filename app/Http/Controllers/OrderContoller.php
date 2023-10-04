<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\StoreOrder;
use App\Http\Requests\Order\UpdateOrder;
use App\Models\Order;
use Illuminate\Http\JsonResponse;

class OrderContoller extends Controller
{

    public function index(): JsonResponse
    {
        $orders = Order::with('user')->with('orderLines')->get();

        return $this->respondJson(true, 'Orders retrieved successfully', 200, $orders);
    }

    public function store(StoreOrder $request): JsonResponse
    {
        $order = Order::create($request->validated());

        return $this->respondJson(true, 'Order created successfully', 201, $order);
    }

    public function show($id): JsonResponse
    {
        $order = Order::with('user')->with('orderLines')->findOrFail($id);

        return $this->respondJson(true, 'Order retrieved successfully', 200, $order);
    }

    public function update(UpdateOrder $request, $id): JsonResponse
    {
        $order = Order::with('user')->with('orderLines')->findOrFail($id);

        $order->update($request->validated());

        return $this->respondJson(true, 'Order updated successfully', 200, $order);
    }

    public function destroy($id)
    {
        $order = Order::with('user')->with('orderLines')->findOrFail($id);

        $order->orderLines()->delete();
        $order->delete();

        return $this->respondJson(true, 'Order deleted successfully', 200, $order);
    }
}
