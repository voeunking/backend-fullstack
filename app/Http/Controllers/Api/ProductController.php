<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        try {
            $products = Product::with('category')->get();
            return response()->json([
                'success'=>true,
                'message'=>'All products loaded successfully!',
                'data'=> $products
            ],Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success'=>false,
                'message'=>'Error fetching products',
                'error'=>$e->getMessage()
            ],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'stock' => 'nullable|integer|min:0',
            'discount_percent' => 'nullable|numeric|min:0|max:100',
        ]);
        if($validator->fails()){
            return response()->json([
                'success'=>false,
                'message'=>'Validation failed',
                'error'=>$validator->errors()
            ]);
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product = Product::create(array_merge($validator->validated(), ['image' => $imagePath]));
        return response()->json([
            'success' => true,
            'message' => 'Product created successfully',
            'data' => $product
        ]);
    }

    public function show(string $id)
    {
        $product = Product::with('category')->find($id);
        if(!$product){
            return response()->json([
                'success'=>false,
                'message'=>'Product not found'
            ],Response::HTTP_NOT_FOUND);
        }
        return response()->json([
            'success'=>true,
            'message'=>'Product found',
            'data'=>$product
        ],Response::HTTP_OK);
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'stock' => 'nullable|integer|min:0',
            'discount_percent' => 'nullable|numeric|min:0|max:100',
        ]);
        if($validator->fails()){
            return response()->json([
                'success'=>false,
                'message'=>'Validation failed',
                'error'=>$validator->errors()
            ]);
        }

        $product = Product::find($id);

        $validated = $validator->validated();

        if ($request->hasFile('image')) {
            if ($product->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);
        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully',
            'data' => $product
        ]);
    }

    public function destroy(string $id)
    {
        $product = Product::find($id);
        if($product){
            $product->delete();
            return response()->json([
                'success'=>true,
                'message'=>'Product deleted'
            ]);
        }
        return response()->json([
            'success'=>false,
            'message'=>'Product not found'
        ], Response::HTTP_NOT_FOUND);
    }
}