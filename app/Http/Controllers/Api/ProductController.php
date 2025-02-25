<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller {
    public function index() {
        return response()->json(Product::all(), 200);
    }

    public function show($id) {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Sản phẩm không tồn tại'], 404);
        }
        return response()->json($product, 200);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $product = Product::create($validated);
        return response()->json($product, 201);
    }

    public function update(Request $request, $id) {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Sản phẩm không tồn tại'], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $product->update($validated);
        return response()->json($product, 200);
    }

    public function destroy($id) {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Sản phẩm không tồn tại'], 404);
        }

        $product->delete();
        return response()->json(['message' => 'Sản phẩm đã được xóa'], 200);
    }
}
