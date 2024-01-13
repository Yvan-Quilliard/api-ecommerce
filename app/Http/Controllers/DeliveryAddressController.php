<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeliveryAddress\StoreDeliveryAddress;
use App\Http\Requests\DeliveryAddress\UpdateDeliveryAddress;
use App\Models\DeliveryAddress;
use Illuminate\Http\JsonResponse;

class DeliveryAddressController extends Controller
{

    public function index(): JsonResponse
    {
        $delivery_addresses = DeliveryAddress::with('user')->get();

        return $this->respondJson(true, 'Delivery Addresses retrieved successfully', 200, $delivery_addresses);
    }

    public function store(StoreDeliveryAddress $request): JsonResponse
    {
        $delivery_address = DeliveryAddress::create($request->validated());

        return $this->respondJson(true, 'Delivery Address created successfully', 201, $delivery_address);
    }

    public function show($id): JsonResponse
    {
        $delivery_address = DeliveryAddress::with('user')->findOrFail($id);

        return $this->respondJson(true, 'Delivery Address retrieved successfully', 200, $delivery_address);
    }

    public function update(UpdateDeliveryAddress $request, $id): JsonResponse
    {
        $delivery_address = DeliveryAddress::with('user')->findOrFail($id);

        $delivery_address->update($request->validated());

        return $this->respondJson(true, 'Delivery Address updated successfully', 200, $delivery_address);
    }

    public function destroy($id): JsonResponse
    {
        $delivery_address = DeliveryAddress::with('user')->findOrFail($id);

        $delivery_address->order()->delete();
        $delivery_address->delete();

        return $this->respondJson(true, 'Delivery Address deleted successfully', 200, $delivery_address);
    }
}
