<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('image');
    
        if ($request->has('name')) {
            $products->where('name', 'like', '%' . $request->input('name') . '%');
        }
        if ($request->has('condition')) {
            $products->where('condition', $request->input('condition'));
        }
        if ($request->has('min_price')) {
            $products->where('price', '>=', $request->input('min_price'));
        }
        if ($request->has('sort')) {
            if ($request->input('sort') == 'latest') {
                $products->latest();
            } else if ($request->input('sort') == 'lower_price') {
                $products->orderBy('price');
            } else if ($request->input('sort') == 'highest_price') {
                $products->orderByDesc('price');
            }
        }
    
        $result = $products->get();
    
        return response()->json([
            'status' => true,
            'message' => 'Successfully found products',
            'data' => ProductResource::collection($result),
        ]);
    }
    public function show($id) {
        try {
            $product = Product::with('image')->find($id);

            if(!$product) {
                return response()->json([
                    'status' => false,
                    'message' => 'product not found'
                ], 404);
            }
            return response()->json([
                'status' => true,
                'message' => 'successful found data product',
                'data' => new ProductResource($product)
            ], 200);
        } catch(\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
    public function store(ProductCreateRequest $request)
    {
        $data = $request->validated();
        $product = Product::create([
            'user_id' => $request->user()->id,
            'name' => $data['name'],
            'condition' => $data['condition'],
            'price' => $data['price'],
            'description' => $data['description'],
            'category' => $data['category'],
        ]);
        
        $this->handleImageUpload($data, $product);

        return response()->json([
            'status' => true,
            'message' => 'Product created successfully',
            'data' => $product,
        ]);
    }

    public function update(ProductCreateRequest $request, $id) {
        try {
            $data = $request->validated();
            $user = $request->user();
            $product = Product::find($id);
            if(!$product) {
                return response()->json([
                    'status' => false,
                    'message' => 'product not found'
                ], 404);
            }
            if ($user->id == $product->user_id || $user->role_id == 1) {
                $product->update($data);

                $this->handleImageUpload($data, $product);
                $product = Product::with('image')->findOrFail($id);
                return response()->json([
                    'status' => true,
                    'message' => 'Product updated successfully',
                    'data' => new ProductResource($product),
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized to update this product',
                ], 403);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Error updating product',
                'error' => $th->getMessage(),
            ], 500);
        }
    }
    public function destroy(Request $request, $id)
    {
        try {
            $user = $request->user();
            $product = Product::with('image')->find($id);
            
            if(!$product) {
                return response()->json([
                    'status' => false,
                    'message' => 'product not found'
                ], 404);
            }
            if ($user->id == $product->user_id || $user->role_id == 1) {
                foreach ($product->image as $image) {
                    Storage::delete('product/' . $image->name_file_image);
                    $image->delete();
                }
    
                $product->delete();
    
                return response()->json([
                    'status' => true,
                    'message' => 'Product deleted successfully',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized to delete this product',
                ], 403);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Error deleting product',
                'error' => $th->getMessage(),
            ], 500);
        }
    }
    
    public function deleteProductImageById(Request $request, $idProduct, $idImage)
    {
        try {
            $user = $request->user();
    
            $product = Product::with('image')->find($idProduct);
            if(!$product) {
                return response()->json([
                    'status' => false,
                    'message' => 'product not found'
                ], 404);
            }
            if ($user->id == $product->user_id || $user->role_id == 1) {

                $image = Image::findOrFail($idImage);

                Storage::delete('product/' . $image->name_file_image);

                $image->delete();
    
                return response()->json([
                    'status' => true,
                    'message' => 'Product image deleted successfully',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized to delete this product image',
                ], 403);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Error deleting product image',
                'error' => $th->getMessage(),
            ], 500);
        }
    }
    private function handleImageUpload($request, $product)
    {
        try{
            if (isset($request['product_image'])) {
                $productImages = $request['product_image'];

                if (!is_array($productImages)) {
                    $productImages = [$productImages];
                }

                foreach ($productImages as $image) {
                    $filename = $image->getClientOriginalName();


                    $image->storeAs('product', $filename);

                    image::updateOrCreate([   
                            'product_id' => $product->id, 
                            'context' => 'product',
                            'name_file_image' => $filename
                        ]
                    );
                }
            }
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error upload product image',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
