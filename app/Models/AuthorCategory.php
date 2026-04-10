<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AuthorCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
    ];
}