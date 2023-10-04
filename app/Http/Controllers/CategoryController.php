<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreCategory;
use App\Http\Requests\Category\UpdateCategory;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{

    public function index(): JsonResponse
    {
        $categories = Category::with('products')->get();

        return $this->respondJson(true, 'Categories retrieved successfully', 200, $categories);
    }

    public function store(StoreCategory $request): JsonResponse
    {
        $category = Category::create($request->validated());

        return $this->respondJson(true, 'Category created successfully', 201, $category);
    }

    public function show($id): JsonResponse
    {
        $category = Category::with('products')->findOrFail($id);

        return $this->respondJson(true, 'Category retrieved successfully', 200, $category);
    }

    public function update(UpdateCategory $request, $id): JsonResponse
    {
        $category = Category::with('products')->findOrFail($id);

        $category->update($request->validated());

        return $this->respondJson(true, 'Category updated successfully', 200, $category);
    }

    public function destroy($id): JsonResponse
    {
        $category = Category::with('products')->findOrFail($id);

        $category->products()->delete();
        $category->delete();

        return $this->respondJson(true, 'Category deleted successfully', 200, $category);
    }
}
