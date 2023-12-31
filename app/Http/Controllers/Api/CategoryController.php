<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategryResource;
use App\Models\Category;
use Illuminate\Http\Request;

use App\Http\Requests\StoreCategryRequest;
use App\Http\Requests\UpdateCategryRequest;
class CategoryController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return Categry::all();
        $Categries= Category::withCount('books')->get();
        return CategryResource::collection($Categries);//transformation From Resources file
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(StoreCategryRequest $request)
    // {
      
    //     $data = $request->all();
        
    //     $categry = Categry::create($data);
    
    //     // return new CategryResource($categry);
    //     return response()->json($categry,201);
    // }
    public function store(StoreCategryRequest $request)
{
    $data = $request->validated();
    
    $categry = Category::withTrashed()->where('name', $data['name'])->first();

    if ($categry) {
        $categry->restore();
        return response()->json($categry, 201);
    }

    $categry = Category::create($data);

    return response()->json($categry, 201);
}


    /**
     * Display the specified resource.
     */
    public function show( $categry)
    {
        $categry = Category::withCount('books')->findOrFail($categry);
        return new CategryResource($categry);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategryRequest $request, $categry)
    {
        $data = $request->validated();
    
        $newCategry = new Category([
            'name' => $data['name'],
            'description' => $data['description'],
        ]);
    
        $categry = Category::findOrFail($categry);
        $categry->delete();
    
        $categry->name = $newCategry->name;
        $categry->description = $newCategry->description;
        $categry->save();
    
        return new CategryResource($categry);
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($categry)
{
    $categry = Category::findOrFail($categry);
    $categry->delete();

    return response()->json(['message' => 'Category deleted successfully']);
}



public function restore($categoryId)
{
    $category = Category::withTrashed()->findOrFail($categoryId);
    $category->restore();

    return response()->json(['message' => 'Category restored successfully']);
}

}
