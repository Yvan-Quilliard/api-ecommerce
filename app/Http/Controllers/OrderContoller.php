<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\StoreOrder;
use App\Http\Requests\Order\UpdateOrder;
use App\Models\Order;

class OrderContoller extends Controller
{

    public function index()
    {
        $orders = Order::with(['user', 'orderLines'])->get()->all();

        return $this->responseJson($orders);
    }

    public function store(StoreOrder $request)
    {
        $order = Order::with('user')->with('orderLines')->create($request->all());

        return $this->responseJson($order);
    }

    public function show($id)
    {
        $order = Order::with('user')->with('orderLines')->find($id);

        if ($order) {
            return $this->responseJson($order);
        } else {
            return $this->responseJson(null, 404, 'Order not found');
        }
    }

    public function update(UpdateOrder $request, $id)
    {
        $order = Order::with('user')->with('orderLines')->find($id);

        if (!$order) {
            return $this->responseJson(null, 404, 'Order not found');
        }

        $order->update($request->all());

        return $this->responseJson($order);
    }

    public function destroy($id)
    {
        $order = Order::with('user')->with('orderLines')->find($id);

        if ($order) {
            $order->delete();
            return $this->responseJson($order);
        } else {
            return $this->responseJson(null, 404, 'Order not found');
        }
    }
}
