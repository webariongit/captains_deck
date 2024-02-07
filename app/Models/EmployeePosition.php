<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeePosition extends Model
{
    // use HasFactory;
    protected $table = "tbl_employee_position_type" ;
    protected $fillable = [
        'name',
    ];
}
