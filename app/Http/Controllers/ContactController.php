<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Schema(
 *     schema="Contact",
 *     type="object",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="first_name", type="string"),
 *     @OA\Property(property="last_name", type="string"),
 *     @OA\Property(property="email", type="string"),
 *     @OA\Property(property="phone", type="string"),
 *     @OA\Property(property="user_id", type="integer")
 * )
 */

class ContactController extends Controller
{

    /**
    * @OA\Get(
    *     path="/api/contacts",
    *     summary="Get all contacts",
    *     tags={"Contacts"},
    *     @OA\Response(
    *         response=200,
    *         description="List of contacts",
    *         @OA\JsonContent(
    *             type="array",
    *             @OA\Items(ref="#/components/schemas/Contact")
    *         )
    *     )
    * )
    */

    // Mendapatkan daftar contact
    public function index(): JsonResponse
    {
        $contacts = Contact::all();
        return response()->json(ContactResource::collection($contacts));
    }

    /**
     * @OA\Post(
     *     path="/api/contacts",
     *     summary="Create a new contact",
     *     tags={"Contacts"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Contact")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Contact created",
     *         @OA\JsonContent(ref="#/components/schemas/Contact")
     *     )
     * )
     */ 
    
    // Membuat contact baru
    public function store(ContactRequest $request): JsonResponse
    {
        $contact = Contact::create($request->validated());
        return response()->json(new ContactResource($contact), 201);
    }

    // Mendapatkan detail contact
    public function show(Contact $contact): JsonResponse
    {
        return response()->json(new ContactResource($contact));
    }

    // Mengupdate contact
    public function update(ContactRequest $request, Contact $contact): JsonResponse
    {
        $contact->update($request->validated());
        return response()->json(new ContactResource($contact));
    }

    // Menghapus contact
    public function destroy(Contact $contact): JsonResponse
    {
        $contact->delete();
        return response()->json(null, 204);
    }
}