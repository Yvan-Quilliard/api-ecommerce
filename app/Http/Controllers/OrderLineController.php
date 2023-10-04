<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderLine\StoreOrderLine;
use App\Http\Requests\OrderLine\UpdateOrderLine;
use App\Models\OrderLine;
use Illuminate\Http\JsonResponse;

class OrderLineController extends Controller
{

    public function index(): JsonResponse
    {
        $orderLine = OrderLine::with('order')->with('products')->get();

        return $this->respondJson(true, 'OrderLines retrieved successfully', 200, $orderLine);
    }

    public function store(StoreOrderLine $request): JsonResponse
    {
        $orderLine = OrderLine::create($request->validated());

        return $this->respondJson(true, 'OrderLine created successfully', 201, $orderLine);
    }

    public function show($id): JsonResponse
    {
        $orderLine = OrderLine::with('order')->with('products')->findOrFail($id);

        return $this->respondJson(true, 'OrderLine retrieved successfully', 200, $orderLine);
    }

    public function update(UpdateOrderLine $request, $id): JsonResponse
    {
        $orderLine = OrderLine::with('order')->with('products')->findOrFail($id);

        $orderLine->update($request->validated());

        return $this->respondJson(true, 'OrderLine updated successfully', 200, $orderLine);
    }

    public function destroy($id): JsonResponse
    {
        $orderLine = OrderLine::with('order')->with('products')->findOrFail($id);

        $orderLine->delete();

        return $this->respondJson(true, 'OrderLine deleted successfully', 200, $orderLine);
    }
}
