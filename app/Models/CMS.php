<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CMS extends Model
{
    // use HasFactory;
    protected $table = "tbl_cms" ;
    protected $fillable = ['title' , 'description'];
}
