<?php

namespace App\Http\Controllers;

use app\Http\Requests\OrderLine\StoreOrderLine;
use app\Http\Requests\OrderLine\UpdateOrderLine;
use App\Models\OrderLine;

class OrderLineController extends Controller
{

    public function index()
    {
        $orderLines = OrderLine::with(['order', 'products'])->get()->all();

        return $this->responseJson($orderLines);
    }

    public function store(StoreOrderLine $request)
    {

    }

    public function show($id)
    {

    }

    public function update(UpdateOrderLine $request, $id)
    {

    }

    public function destroy($id)
    {

    }
}
