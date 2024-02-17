<?php

namespace App\Services;

use App\Interfaces\OrderInterface;
use App\Jobs\MailNewOrderJob;
use App\Models\DeliveryAddress;
use App\Models\Order;
use App\Models\OrderLine;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\FontMetrics;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewOrderMail;

class ServiceOrder implements OrderInterface
{

    public function createOrder(Request $request): JsonResponse
    {

        $user = $request->user();
        $orderLines = json_decode($request->order_lines);
        $deliveryAddress = json_decode($request->delivery_address);

        try {
            $deliveryAddress = DeliveryAddress::where('user_id', $user->id)->findOrFail($deliveryAddress->id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Delivery address not found',
                'data' => [],
            ], 404);
        }

        foreach ($orderLines as $orderLine) {
            if ($orderLine->quantity < 1) {
                return response()->json([
                    'success' => false,
                    'message' => 'Quantity must be greater than 0',
                    'data' => [],
                ], 400);
            }
        }

        foreach ($orderLines as $orderLine) {
            $product = $this->getProduct($orderLine->product_id);
            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found',
                    'data' => [],
                ], 404);
            }
        }

        foreach ($orderLines as $orderLine) {
            $price = $this->getProduct($orderLine->product_id)->price;
            if ($price < 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Price must be greater than 0',
                    'data' => [],
                ], 400);
            }
        }

        $order = Order::create([
            'user_id' => $user->id,
            'delivery_address_id' => $deliveryAddress->id,
            'order_date' => now(),
            'status' => 'processing',
        ]);

        foreach ($orderLines as $orderLine) {

            $product = $this->getProduct($orderLine->product_id);
            $quantity = $orderLine->quantity;
            $price = $product->price * $quantity;

            OrderLine::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $price,
            ]);
        }

        $order = Order::with(['orderLines.product', 'deliveryAddress', 'user'])->find($order->id);

        Mail::send(new NewOrderMail($user, $order));

        return response()->json([
            'success' => true,
            'message' => 'Order created successfully',
            'data' => $order,
        ], 201);

    }

    public function generateOrderSummaryPdf($id): Response
    {
        $order = Order::with(['orderLines.product', 'deliveryAddress', 'user'])->findOrFail($id);

        $pdf = PDF::setOption('defaultFont', 'Comfortaa-Medium');
        $pdf->loadView('pdf.order-summary', ['order' => $order]);
        return $pdf->stream('order-summary.pdf');
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
