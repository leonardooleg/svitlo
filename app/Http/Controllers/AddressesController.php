<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressesRequest;
use Illuminate\Http\Request;
use App\Models\Address;
use App\Http\Resources\AddressesResource;

class AddressesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return AddressesResource::collection(Address::all());

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddressesRequest  $request)
    {
        $company = Address::create($request->validated());

        return new AddressesResource($company);
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $addresses)
    {
        return new AddressesResource($addresses);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $address = Address::find($id);

        $addressName = $request->input('name');
        $isPublic = $request->input('public');

        // Check for null values
        $publicLink = $request->input('link') === null ? null : $request->input('link');

        // Update address in database
        $address->name = $addressName;
        $address->public = (int)$isPublic;
        $address->link = $publicLink;
        $address->save();


        return response()->json([
            'message' => 'Record updated successfully',
        ]);
    }

    /*public function update(AddressesRequest $request, Address $addresses)
    {
        $addresses->update($request->validated());

        return new AddressesResource($addresses);
    }*/

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $addresses)
    {
        $addresses->delete();

        return response()->noContent();
    }
}
