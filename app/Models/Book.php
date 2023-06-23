<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Book extends Model
{
    use HasFactory;
    use SoftDeletes;


  protected $fillable =[

    'title','description','author_id','category_id','image'
  ];

  protected $casts = [
    'category_id' => 'array', 
];


    public function author()
    {
        return $this->belongsTo(Author::class);
    }


    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
