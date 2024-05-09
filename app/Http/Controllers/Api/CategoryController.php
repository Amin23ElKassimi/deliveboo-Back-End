<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // INDEX
    public function index()
    {
        $categories = Category::with('restaurants')->paginate(10);
        return response()->json([
            'success' => true,
            'results' => $categories,

        ]);
    }
    // SHOW
    public function show(Category $category)
    {
        return response()->json([
            'success' => true,
            'results' => $category,
        ]);
    }
}
