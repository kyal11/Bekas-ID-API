<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index(Request $request)
    {
        try {
            $searchName = $request->input('name');
            
            $users = User::with('image')
            ->when($searchName, fn ($query) => $query->where('name', 'like', '%' . $searchName . '%'))
            ->get();
            
            if ($users->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'message' => 'No users found',
                    'data' => []
                ], 404);
            }
    
            return response()->json([
                'status' => true,
                'message' => 'successful found users',
                'data' => UserResource::collection($users)
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
    
    public function show($id) {
        try {
            $user = User::with('image')->findOrFail($id);
            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'No users found',
                ], 404);
            }
            return response()->json([
                'status' => true,
                'message' => 'successful found users',
                'data' => new UserResource($user)
            ], 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
    

    public function update(UserUpdateRequest $request)
    {
        try {
            $data = $request->validated();
    
            $user = $request->user();
    
            $user->update($data);
    
            if ($request->hasFile('image_profile')) {
                $filename = $request->image_profile->getClientOriginalName();
    
                image::updateOrCreate(
                    ['user_id' => $user->id, 'context' => 'profile'],
                    ['name_file_image' => $filename]
                );
    
                $request->image_profile->storeAs('profile', $filename);
            }
    
            return response()->json([
                'status' => true,
                'message' => 'successful update user',
                'data' => new UserResource($user)
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
    
    public function getUserWithReview($id)
    {
        try {
            $user = User::with(['image', 'sellerReview'])->findOrFail($id);

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'User not found',
                ], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'Successful found user with reviews',
                'data' => new UserResource($user)
            ], 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

}
