<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id)
    {
        return response()->json(['product_id' => $id]);
    }

    public function update(Request $request, Product $product)
{
    $this->authorize('update', $product);

    $product->update($request->all());

    return response()->json(['success' => true]);
}
public function store(Request $request)
{
    // Validate incoming request
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'quantity' => 'required|integer',
    ]);

    // Create new product
    $product = Product::create($validated);

    // Return response with success message and created product
    return response()->json([
        'success' => true,
        'message' => 'Product created successfully',
        'product' => $product,
    ], 201);
}


}
