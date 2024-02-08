<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GetInTouch extends Model
{
    // use HasFactory;
    // protected $guarded = [];
    protected $table = "tbl_get_touch" ;
    protected $fillable = ['media_type', 'media'];
}
