<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    // use HasFactory;
    protected $table = "menus" ;
    protected $fillable = [
        'category_id',
        'subcategory_id',
        'subsubcategory_id',
        'food_type_id',
        'meal_image',
        'meal_qty',
        'meal_amount',
        'meal_description',
    ];
}
