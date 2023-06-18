<?php

namespace App\Http\Controllers;

use App\Http\Services\Media;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;

use App\Models\Book;
use Illuminate\Http\Request;


class bookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $books = Book::all();
        return response()->json(compact('books'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {

        $data = $request->except('image');
        if($request->hasFile('image')){
            $data['image'] = Media::upload($request->image,'images\books');

        }
        if (Book::create($data)){
            return response()->json(['success'=>true,'message'=>'Book Added Successfully']);

        }else {
            return response()->json(['success'=>false,'message'=>'somthing went'],500);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    // public function edit( Book $book)
    // {

    //         return response()->json(compact('book'));
        
    // }



    /**
      * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
     

        $data = $request->except('image');
        if($request->hasFile('image')){
            $data['image'] = Media::upload($request->image,'images\books');

        }
        if ($book->update($data)){
            return response()->json(['success'=>true,'message'=>'Book Updated Successfully']);

        }else {
            return response()->json(['success'=>false,'message'=>'somthing went'],500);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
     
        $book->delete();
        return response()->json(['success'=>true,'message'=>'Book Deleted Successfully']);

    }
}
