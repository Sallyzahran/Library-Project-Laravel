<?php

namespace App\Http\Controllers\Api;
use App\Models\Author;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return Author::all();
        $authors = Author::withCount('books')->get();

        return response()->json($authors);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate(Author::rules());

        $author = Author::create($validatedData);

        return response()->json($author);
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        return $author;
        $author->load('books');

        return response()->json($author);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        $validatedData = $request->validate(Author::rules($author->id));
        $author->update($validatedData);

        return response()->json($author);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        $author->delete();

        return response()->json(null, 204);
    }
}
