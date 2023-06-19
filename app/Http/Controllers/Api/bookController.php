<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\Media;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookCollection;



use App\Models\Book;


use Illuminate\Http\Request;


class bookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $books = Book::with('category', 'author')->get();
        return new BookCollection($books);
   
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {

        $data = $request->except('image');
        if($request->hasFile('image')){
            $data['image'] = Media::upload($request->image,'images/books');

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
  

    // public function edit( Book $book)
    // {

    //         return response()->json(compact('book'));
        
    // }

    public function show(Book $book)
{
    return new BookCollection(collect([$book]));
}


public function filter(Request $request)
{
    $query = Book::with('category', 'author');

    if ($request->has('order_by')) {
        $orderBy = $request->get('order_by');
        if ($orderBy === 'name') {
            $query->orderBy('title', 'asc');
        } elseif ($orderBy === 'latest') {
            $query->latest('updated_at');
        }
    }

    if ($request->has('search')) {
        $search = $request->get('search');
        $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
                ->orWhereHas('author', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
        });
    }

    if ($request->has('category_id')) {
        $category_id = $request->get('category_id');
        $query->whereHas('category', function ($q) use ($category_id) {
            $q->where('id', $category_id);
        });
    }

    $books = $query->get();
  if ($books->count() === 0) {
        return response()->json(['message' => 'No books found'], 404);
    }

    if ($books->count() === 1) {
        return new BookCollection(collect([$books->first()]));
    }

    return new BookCollection($books);
}



    /**
      * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
     

        $data = $request->except('image');
        if($request->hasFile('image')){
            $data['image'] = Media::upload($request->image,'images/books');

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
        Media::delete(public_path(("images\books\\{$book->image}")));
     
        $book->delete();
        return response()->json(['success'=>true,'message'=>'Book Deleted Successfully']);

    }
}
