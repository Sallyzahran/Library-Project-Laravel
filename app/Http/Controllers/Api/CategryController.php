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
        $data = $request->validate([
            'name' => 'required|unique:categries|max:20',
            'description' => 'required',
        ]);
        
        $categry = Categry::create($data);
    
        // return new CategryResource($categry);
        return response()->json($categry,201);
    }
    

    /**
     * Display the specified resource.
     */
    public function show( $categry)
    {
        $categry= Categry::find($categry);
        return new CategryResource($categry);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $categry)
    {
        $categry = Categry::findOrFail($categry);
    
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
    
        $categry->update($data);
    
        return new CategryResource($categry);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($categry)
{
    $categry = Categry::findOrFail($categry);
    $categry->delete();

    return response()->json(['message' => 'Category deleted successfully']);
}



public function restore($categoryId)
{
    $category = Categry::withTrashed()->findOrFail($categoryId);
    $category->restore();

    return response()->json(['message' => 'Category restored successfully']);
}



}
