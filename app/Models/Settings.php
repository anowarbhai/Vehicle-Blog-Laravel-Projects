<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $fillable = ['site_name', 'logo', 'fav_icon', 'email', 'phone', 'address', 'copyright', 'facebook', 'instagram', 'twitter', 'youtube', 'meta_title', 'meta_desc', 'meta_keyword'];

}