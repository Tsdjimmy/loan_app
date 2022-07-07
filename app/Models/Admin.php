<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'image',
        'phone'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
