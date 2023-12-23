<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferCreateRequest;
use App\Http\Requests\OfferUpdateRequest;
use App\Http\Resources\OfferResource;
use App\Models\offers;
use App\Models\product;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function store(OfferCreateRequest $request, $id)
    {
        try {
            $data = $request->validated();
            $user = $request->user();
            $product = product::find($id);

            if (!$product) {
                return response()->json([
                    'status' => false,
                    'message' => 'Product not found'
                ], 404);
            }

            $offer = $product->offer()->create([
                'user_id' => $user->id,
                'seller_id' => $product->user_id,
                'price' => $data['price'],
                'status' => 'pending'
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Offer created successfully',
                'data' => new OfferResource($offer)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Error creating offer',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function setAcceptOffer(Request $request, $idProduct, $idOffer)
    {
        try {
            $product = Product::find($idProduct);
            $offer = offers::find($idOffer);
            $user = $request->user();

            if (!$product || !$offer) {
                return response()->json([
                    'status' => false,
                    'message' => 'Product or Offer not found'
                ], 404);
            }

            if ($user->id != $product->user_id) {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized to accept this offer'
                ], 403);
            }

            $offer->status = 'accepted';
            $offer->save();

            return response()->json([
                'status' => true,
                'message' => 'Offer accepted successfully',
                'data' => new OfferResource($offer)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Error accepting offer',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function setRejectOffer($idProduct, $idOffer)
    {
        try {
            $product = product::find($idProduct);
            $offer = offers::find($idOffer);

            if (!$product || !$offer) {
                return response()->json([
                    'status' => false,
                    'message' => 'Product or Offer not found'
                ], 404);
            }

            $offer->status = 'rejected';
            $offer->save();

            return response()->json([
                'status' => true,
                'message' => 'Offer rejected successfully',
                'data' => new OfferResource($offer)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Error rejecting offer',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function getAllOffers($idProduct)
    {
        try {
            $offers = offers::where('product_id', $idProduct)->get();

            return response()->json([
                'status' => true,
                'message' => 'All offers retrieved successfully',
                'data' => OfferResource::collection($offers)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Error retrieving offers',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function getDetailOffer($idProduct, $idOffer)
    {
        try {
            $offer = offers::where('product_id', $idProduct)->find($idOffer);

            if (!$offer) {
                return response()->json([
                    'status' => false,
                    'message' => 'Offer not found'
                ], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'Offer retrieved successfully',
                'data' => new OfferResource($offer)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Error retrieving offer',
                'error' => $th->getMessage(),
            ], 500);
        }
    }
    public function updateOffer(OfferCreateRequest $request, $idProduct, $idOffer)
    {
        try {
            $offer = offers::where('product_id', $idProduct)->find($idOffer);
            if (!$offer) {
                return response()->json([
                    'status' => false,
                    'message' => 'Offer not found'
                ], 404);
            }

            $data = $request->validated();

            $offer->update($data);

            return response()->json([
                'status' => true,
                'message' => 'Offer updated successfully',
                'data' => new OfferResource($offer)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Error updating offer',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function deleteOffer($idProduct, $idOffer)
    {
        try {
            $offer = offers::where('product_id', $idProduct)->find($idOffer);

            if (!$offer) {
                return response()->json([
                    'status' => false,
                    'message' => 'Offer not found'
                ], 404);
            }

            $offer->delete();

            return response()->json([
                'status' => true,
                'message' => 'Offer deleted successfully'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Error deleting offer',
                'error' => $th->getMessage(),
            ], 500);
        }
    }
}
