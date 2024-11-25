<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'image',
        'description',
        'user_id',
        'meta_title',
        'meta_desc',
        'meta_keyword',
    ];

    // Define the relationship with Post
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    // Define the relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}