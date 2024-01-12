<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface OrderInterface
{
    public function createOrder(Request $request);
}
