<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Author extends Model
{

    use HasFactory;

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function books()
{
    return $this->hasMany(Book::class);
}


    public function getTotalBooksAttribute()
{
    return $this->books()->count();
}
protected $fillable = ['name'];

public static function rules()
{
    return [
        'name' => 'required|max:20',
    ];
}

}
