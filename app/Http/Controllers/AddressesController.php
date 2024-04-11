<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressesRequest;
use Illuminate\Http\Request;
use App\Models\Addresses;
use App\Http\Resources\AddressesResource;

class AddressesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return AddressesResource::collection(Addresses::all());

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
        $company = Addresses::create($request->validated());

        return new AddressesResource($company);
    }

    /**
     * Display the specified resource.
     */
    public function show(Addresses $addresses)
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
    public function update(AddressesRequest $request, Addresses $addresses)
    {
        $addresses->update($request->validated());

        return new AddressesResource($addresses);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Addresses $addresses)
    {
        $addresses->delete();

        return response()->noContent();
    }
}
