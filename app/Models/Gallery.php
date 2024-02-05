<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    // use HasFactory;
    protected $guarded = [];
    protected $table = "gallerys" ;
    protected $fillable = ['media_type', 'media'];
}
