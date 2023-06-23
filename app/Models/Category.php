<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
class Category extends Model
{
    use HasFactory,SoftDeletes;

    
    public function books()
    {
        return $this->hasMany(Book::class);
    }
    // protected $appends = ['books_count'];

    // public function getBooksCountAttribute()
    // {
    //     return $this->books()->count();
    // }
   
    protected $fillable=[
        'name',
        'description',
        
    ];
}
