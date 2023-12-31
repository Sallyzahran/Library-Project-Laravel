<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BookCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request)
    {
        if ($request->route()->getName() === 'books.show') {
            $book = $this->collection->first();
            return [
                'id' => $book->id,
                'title' => $book->title,
                'description' => $book->description,
                'image' => $book->image,
                'author' => [
                    'id' => $book->author->id,
                    'name' => $book->author->name,
                ],
                'categories' => $book->categories->map(function ($category) {
                    return [
                        'id' => $category->id,
                        'name' => $category->name,
                    ];
                }),
    
            
            ];
        } else {
            return [
                'books' => $this->collection->map(function ($book) {
                    return [
                        'id' => $book->id,
                        'title' => $book->title,
                        'description' => $book->description,
                        'image' => $book->image,
                        'author' => [
                            'id' => $book->author->id,
                            'name' => $book->author->name,
                        ],
                        'categories' => $book->categories->map(function ($category) {
                            return [
                                'id' => $category->id,
                                'name' => $category->name,
                            ];
                        }),
            
                    
                    ];
                }),
            ];
        }    }
}
