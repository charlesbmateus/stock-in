<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        Product::all();
        return response()->json(Product::all());
    }

    public function store(request $request)
    {
        xdebug_break();
        // Validation of request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'quality' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'sell' => 'boolean',
            'send' => 'boolean',
            'description' => 'nullable|string',
        ]);

        // Crear el producto en la base de datos
        $product = Product::create([
            'name' => $validatedData['name'],
            'category' => $validatedData['category'],
            'stock' => $validatedData['stock'],
            'quality' => $validatedData['quality'],
            'price' => $validatedData['price'],
            'sell' => $validatedData['to-sell'] ?? true,
            'send' => $validatedData['to-send'] ?? true,
            'description' => $validatedData['description'],
        ]);

        // Return a JSON response with the created product
        return response()->json([
            'message' => 'Product successfully created',
            'product' => $product
        ], 201);
    }

    public function update(request $request, Product $product)
    {
        xdebug_break();
        // Validation of request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'quality' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'sell' => 'boolean',
            'send' => 'boolean',
            'description' => 'nullable|string',
        ]);

        $product->update($validatedData);

        // Retornar una respuesta exitosa
        return response()->json([
            'message' => 'Producto actualizado exitosamente',
            'product' => $product,
        ], 200);
    }
}
