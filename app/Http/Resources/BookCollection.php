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
                    'category' => [
                        'id' => $book->category->id,
                        'name' => $book->category->name,
                        'description' => $book->category->description,
                    ],
                ];
            }),
        ];    }
}
