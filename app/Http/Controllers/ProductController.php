<?php

namespace App\Http\Controllers;

use app\Http\Requests\Product\StoreProduct;
use app\Http\Requests\Product\UpdateProduct;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(): JsonResponse
    {
        $products = Product::with('category')->get();

        return $this->respondJson(true, 'Products retrieved successfully', 200, $products);
    }

    public function store(StoreProduct $request): JsonResponse
    {
        $product = Product::create($request->validated());

        return $this->respondJson(true, 'Product created successfully', 201, $product);
    }

    public function show($id): JsonResponse
    {
        $product = Product::with('category')->findOrFail($id);

        return $this->respondJson(true, 'Product retrieved successfully', 200, $product);
    }

    public function update(UpdateProduct $request, $id): JsonResponse
    {
        $product = Product::with('category')->findOrFail($id);

        $product->update($request->validated());

        return $this->respondJson(true, 'Product updated successfully', 200, $product);
    }

    public function destroy($id): JsonResponse
    {
        $product = Product::with('category')->findOrFail($id);

        $product->delete();

        return $this->respondJson(true, 'Product deleted successfully', 200, $product);
    }
}
