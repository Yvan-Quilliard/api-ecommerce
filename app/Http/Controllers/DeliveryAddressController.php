<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeliveryAddress\StoreDeliveryAddress;
use App\Http\Requests\DeliveryAddress\UpdateDeliveryAddress;
use App\Models\DeliveryAddress;

class DeliveryAddressController extends Controller
{

    public function index()
    {
        $delivery_addresses = DeliveryAddress::with('order')->get()->all();

        return $this->responseJson($delivery_addresses);

    }

    public function store(StoreDeliveryAddress $request)
    {
        $delivery_address = DeliveryAddress::with('order')->create($request->all());

        return $this->responseJson($delivery_address);
    }

    public function show($id)
    {
        $delivery_address = DeliveryAddress::with('order')->find($id);

        if ($delivery_address) {
            return $this->responseJson($delivery_address);
        } else {
            return $this->responseJson(null, 404, 'Delivery Address not found');
        }
    }

    public function update(UpdateDeliveryAddress $request, $id)
    {
        $delivery_address = DeliveryAddress::with('order')->find($id);

        if (!$delivery_address) {
            return $this->responseJson(null, 404, 'Delivery Address not found');
        }

        $delivery_address->update($request->all());

        return $this->responseJson($delivery_address);
    }

    public function destroy($id)
    {
        $delivery_address = DeliveryAddress::with('order')->find($id);

        if ($delivery_address) {
            $delivery_address->delete();
            return $this->responseJson($delivery_address);
        } else {
            return $this->responseJson(null, 404, 'Delivery Address not found');
        }
    }
}
