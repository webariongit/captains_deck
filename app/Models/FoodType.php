<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodType extends Model
{
    // use HasFactory;
    protected $table = "tbl_food_types" ;
    protected $fillable = ['food_type_name' , 'status'];
}
