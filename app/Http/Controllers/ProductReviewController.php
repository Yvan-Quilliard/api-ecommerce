<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductReview\StoreProductReview;
use App\Http\Requests\ProductReview\UpdateProductReview;
use App\Models\ProductReview;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Js;

class ProductReviewController extends Controller
{

    public function index(): JsonResponse
    {
        $productReviews = ProductReview::with('product')->with('user')->get();

        return $this->respondJson(true, 'ProductReviews retrieved successfully', 200, $productReviews);
    }

    public function store(StoreProductReview $request): JsonResponse
    {
        $productReview = ProductReview::create($request->validated());

        return $this->respondJson(true, 'ProductReview created successfully', 201, $productReview);
    }

    public function show($id): JsonResponse
    {
        $productReview = ProductReview::with('product')->with('user')->findOrFail($id);

        return $this->respondJson(true, 'ProductReview retrieved successfully', 200, $productReview);
    }

    public function update(UpdateProductReview $request, $id): JsonResponse
    {
        $productReview = ProductReview::with('product')->with('user')->findOrFail($id);

        $productReview->update($request->validated());

        return $this->respondJson(true, 'ProductReview updated successfully', 200, $productReview);
    }

    public function destroy($id): JsonResponse
    {
        $productReview = ProductReview::with('product')->with('user')->findOrFail($id);

        $productReview->delete();

        return $this->respondJson(true, 'ProductReview deleted successfully', 200, $productReview);
    }
}
