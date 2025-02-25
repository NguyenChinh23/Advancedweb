<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller {
    public function index() {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create() {
        return view('products.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        Product::create($validated);
        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được thêm thành công!');
    }

    public function edit($id) {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id) {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $product->update($validated);
        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được cập nhật thành công!');
    }

    public function destroy($id) {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được xóa!');
    }
}
