<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategryResource;
use App\Models\Categry;
use Illuminate\Http\Request;

class CategryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return Categry::all();
        $Categries= Categry::all();
        return CategryResource::collection($Categries);//transformation From Resources file
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
