<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            $categories = Category::all();

            return response()->json([
                'status' => true,
                'message' => 'Categories retrieved successfully',
                'data' => $categories,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error retrieving categories',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $category = category::find($id);

            if (!$category) {
                return response()->json([
                    'status' => false,
                    'message' => 'Category not found',
                ], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'Category retrieved successfully',
                'data' => $category,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error retrieving category',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|unique:categories|max:255',
            ]);

            $user = $request->user();

            if ($user->role_id == 1) {
                $category = category::create([
                    'name' => $request->input('name'),
                ]);
    
                return response()->json([
                    'status' => true,
                    'message' => 'Category created successfully',
                    'data' => $category,
                ], 201);
            }
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized access',
            ], 403);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error creating category',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|unique:categories|max:255',
            ]);
            $user = $request->user();

            if ($user->role_id == 1) {
                $category = category::find($id);

                if (!$category) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Category not found',
                    ], 404);
                }

                $category->update([
                    'name' => $request->input('name'),
                ]);

                return response()->json([
                    'status' => true,
                    'message' => 'Category updated successfully',
                    'data' => $category,
                ]);
            }
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized access',
            ], 403);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error updating category',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            $user = $request->user();

            if ($user->role_id == 1) {
                $category = category::find($id);

                if (!$category) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Category not found',
                    ], 404);
                }

                $category->delete();

                return response()->json([
                    'status' => true,
                    'message' => 'Category deleted successfully',
                ]);
            }
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized access',
            ], 403);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error deleting category',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getProductByCategory($id)
    {
        try {
            $category = category::find($id);

            if (!$category) {
                return response()->json([
                    'status' => false,
                    'message' => 'Category not found',
                ], 404);
            }

            $products = product::where('category_id', $id)->get();

            return response()->json([
                'status' => true,
                'message' => 'Products retrieved successfully by category',
                'data' => $products,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error retrieving products by category',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
