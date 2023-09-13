<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreCategory;
use App\Http\Requests\Category\UpdateCategory;
use App\Models\Category;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::with('products')->get()->all();

        return $this->responseJson($categories);
    }

    public function store(StoreCategory $request)
    {
        $category = Category::create($request->all());

        return $this->responseJson($category);
    }

    public function show($id)
    {
        $category = Category::with('products')->find($id);

        if ($category) {
            return $this->responseJson($category);
        } else {
            return $this->responseJson(null, 404, 'Category not found');
        }
    }

    public function update(UpdateCategory $request, $id)
    {
        $category = Category::with('products')->find($id);

        if (!$category) {
            return $this->responseJson(null, 404, 'Category not found');
        }

        $category->update($request->all());

        return $this->responseJson($category);
    }

    public function destroy($id)
    {
        $category = Category::with('products')->find($id);

        if ($category) {
            $category->delete();
            return $this->responseJson($category);
        } else {
            return $this->responseJson(null, 404, 'Category not found');
        }
    }
}
