<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Manager extends Authenticatable
{
    use HasFactory , Notifiable;

    
    protected $guarded = [];

    // Define the role options
    public static $roleOptions = [
        'Super admin' => 'Super admin',
        'Admin' => 'Admin',
        'Viewer' => 'Viewer',
    ];
}
