<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
class Categry extends Model
{
    use HasFactory, SoftDeletes;
    // protected $dates = ['deleted_at'];
    protected $table = 'categories';

    public function books()
    {
        return $this->hasMany(Book::class);
    }
    
    
        public function getTotalBooksAttribute()
    {
        return $this->books()->count();
    }
    protected $fillable=[
        'name',
        'description',
        
    ];
}
