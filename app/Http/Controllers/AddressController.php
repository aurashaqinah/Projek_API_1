<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Schema(
 *     schema="Address",
 *     type="object",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="street", type="string"),
 *     @OA\Property(property="city", type="string"),
 *     @OA\Property(property="province", type="string"),
 *     @OA\Property(property="country", type="string"),
 *     @OA\Property(property="postal_code", type="string"),
 *     @OA\Property(property="contact_id", type="integer")
 * )
 */

class AddressController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/address",
     *     summary="Get all address",
     *     tags={"Address"},
     *     @OA\Response(
     *         response=200,
     *         description="List of address",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Address")
     *         )
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        $addresses = Address::all();
        return response()->json(AddressResource::collection($addresses));
    }
    

    // Membuat address baru
    public function store(AddressRequest $request): JsonResponse
    {
        $address = Address::create($request->validated());
        return response()->json(new AddressResource($address), 201);
    }
    
    /**
     * @OA\Post(
     *     path="/api/address",
     *     summary="Create a new address",
     *     tags={"Address"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Address")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Address created",
     *         @OA\JsonContent(ref="#/components/schemas/Address")
     *     )
     * )
     */

    // Mendapatkan detail address
    public function show(Address $address): JsonResponse
    {
        return response()->json(new AddressResource($address));
    }

    // Mengupdate address
    public function update(AddressRequest $request, Address $address): JsonResponse
    {
        $address->update($request->validated());
        return response()->json(new AddressResource($address));
    }

    // Menghapus address
    public function destroy(Address $address): JsonResponse
    {
        $address->delete();
        return response()->json(null, 204);
    }
}