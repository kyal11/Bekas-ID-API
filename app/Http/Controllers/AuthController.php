<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthCreateRequest;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Resources\AuthResource;
use App\Models\image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(AuthCreateRequest $request)
    {
        $data = $request->validated();

        if ($data['password'] == $data['confirm_password']) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'phone_number' => $data['phone_number']
            ]);
    
            if (isset($data['image_profile'])) {
                $filename = $request->image_profile->getClientOriginalName();
    
                image::create([
                    'user_id' => $user->id,
                    'context' => 'profile',
                    'name_file_image' => $filename
                ]);
    
                Storage::putFileAs('profile', $request->image_profile, $filename);
            }
    
            return (new AuthResource($user, 'account created successfully'))->response()->setStatusCode(201);
        }
    
        return response()->json([
            'status' => false,
            'message' => 'Password doesn\'t match'
        ], 400);
    }

    public function login(AuthLoginRequest $request) {
        $data = $request->validated();
        
        $user = User::where('email', $data['email'])->first();

        if (!$user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'The provided credentials are incorrect.'
            ], 401);
        }
        $token = $user->createToken('auth_token')->plainTextToken;
        return (new AuthResource($user, "login successful"))->additional([
            'data' => [
                'token' => $token,
                'token_type' => 'Bearer'
            ]
        ]);
    }
    public function currentUser(Request $request) {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'No active sessions found for the user.',
            ], 400);
        }

        return response()->json([
            'status' => true,
            'message' => 'successful finding the current account',
            'data' => $user
        ]);
    }
    
    public function logout(Request $request)
    {
        $user = $request->user();

        if (!$user || !$user->tokens()->count()) {
            return response()->json([
                'status' => false,
                'message' => 'No active sessions found for the user.',
            ], 400);
        }

        try {
            $user->tokens()->delete();
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to logout. Please try again.',
            ], 500);
        }

        return response()->json([
            'status' => true,
            'message' => 'Logout successful',
        ]);
    }
}

