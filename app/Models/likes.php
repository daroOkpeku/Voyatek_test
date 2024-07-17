<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class likes extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_like',
         'user_id',
         'blog_id',
    ];
}
