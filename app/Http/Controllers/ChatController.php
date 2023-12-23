<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChatRequest;
use App\Http\Resources\ChatResource;
use App\Models\chat;
use App\Models\offers;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function store(ChatRequest $request)
    {
        $data = $request->validated();
        $user = $request->user();

        $chat = chat::create([
            'user_id' => $user->id,
            'seller_id' => $data['seller_id'],
            'offer_id' => $data['offer_id'],
            'sender_type' => $data['sender_type'],
            'chat' => $data['chat'],
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Chat created successfully',
            'data' => new ChatResource($chat),
        ]);
    }

    public function getChatBetweenUserAndSeller(Request $request, $idUser, $idSeller)
    {
        try {
            $user = $request->user();

            if ($user->id == $idUser || $user->id == $idSeller || $user->role_id == 1) {
                $chats = Chat::where(function ($query) use ($idUser, $idSeller) {
                    $query->where('user_id', $idUser)
                        ->where('seller_id', $idSeller);
                })->orWhere(function ($query) use ($idUser, $idSeller) {
                    $query->where('user_id', $idSeller)
                        ->where('seller_id', $idUser);
                })->orderBy('created_at', 'asc')->get();

                return response()->json([
                    'status' => true,
                    'message' => 'Chat history retrieved successfully',
                    'data' => $chats,
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized to access this chat history',
                ], 403);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Error retrieving chat history',
                'error' => $th->getMessage(),
            ], 500);
        }
    }
    
    public function getChatByOffer(Request $request, $id)
    {
        try {
            $user = $request->user();
            $offer = offers::find($id);

            if (!$offer) {
                return response()->json([
                    'status' => false,
                    'message' => 'Offer not found',
                ], 404);
            }

            if ($user->id == $offer->user_id || $user->id == $offer->seller_id || $user->role_id == 1) {
                $chats = Chat::where('offer_id', $id)->orderBy('created_at', 'asc')->get();

                return response()->json([
                    'status' => true,
                    'message' => 'Chat history retrieved successfully',
                    'data' => $chats,
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized to access this chat history for the given offer',
                ], 403);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Error retrieving chat history',
                'error' => $th->getMessage(),
            ], 500);
        }
    }
    public function destroyByUserAndSeller(Request $request, $userId, $sellerId)
    {
        try {
            $user = $request->user();

            // Pastikan hanya user atau seller yang terlibat yang dapat menghapus data chat
            if ($user->id == $userId || $user->id == $sellerId || $user->role_id == 1) {
                // Hapus semua chat yang terkait dengan user dan seller
                Chat::where(function ($query) use ($userId, $sellerId) {
                    $query->where('user_id', $userId)
                        ->where('seller_id', $sellerId);
                })->orWhere(function ($query) use ($userId, $sellerId) {
                    $query->where('user_id', $sellerId)
                        ->where('seller_id', $userId);
                })->delete();

                return response()->json([
                    'status' => true,
                    'message' => 'Chat history deleted successfully',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized to delete chat history for the given users',
                ], 403);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Error deleting chat history',
                'error' => $th->getMessage(),
            ], 500);
        }
    }
    public function destroyByOffer(Request $request, $offerId)
    {
        try {
            $user = $request->user();
            $offer = offers::find($offerId);

            // Pastikan offer ditemukan
            if (!$offer) {
                return response()->json([
                    'status' => false,
                    'message' => 'Offer not found',
                ], 404);
            }

            // Pastikan hanya user atau seller yang terlibat dalam offer yang dapat menghapus data chat
            if ($user->id == $offer->user_id || $user->id == $offer->seller_id || $user->role_id == 1) {
                // Hapus semua chat yang terkait dengan penawaran
                Chat::where('offer_id', $offerId)->delete();

                return response()->json([
                    'status' => true,
                    'message' => 'Chat history deleted successfully',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized to delete chat history for the given offer',
                ], 403);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Error deleting chat history',
                'error' => $th->getMessage(),
            ], 500);
        }
    }
}
