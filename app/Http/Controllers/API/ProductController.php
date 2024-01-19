<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $take = $request->query('take', 10);
        $skip = $request->query('skip', 0);
        $search = $request->query('search', '');

        $query = Product::query();

        if (!empty($search)) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $total = $query->count();

        $products = $query->skip($skip)->take($take)->get();

        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' => [
                'total' => $total,
                'products' => $products,
            ],
        ]);
    }

    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'code' => 404,
                'message' => 'Product not found',
                'data' => null,
            ], 404);
        }

        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' => $product,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable',
        ]);

        $product = Product::create($request->all());

        return response()->json([
            'code' => 201,
            'message' => 'Product created successfully',
            'data' => $product,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'code' => 404,
                'message' => 'Product not found',
                'data' => null,
            ], 404);
        }

        $this->validate($request, [
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable',
        ]);

        $product->update($request->all());

        return response()->json([
            'code' => 200,
            'message' => 'Product updated successfully',
            'data' => $product,
        ]);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'code' => 404,
                'message' => 'Product not found',
                'data' => null,
            ], 404);
        }

        $product->delete();

        return response()->json([
            'code' => 200,
            'message' => 'Product deleted successfully',
            'data' => null,
        ]);
    }
}
