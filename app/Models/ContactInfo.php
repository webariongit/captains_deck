<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    protected $table = 'tbl_contact_info';

    protected $fillable = [
        'phone_code',
        'contact',
        'email',
        'address',
        'facebook',
        'instagram',
        'twitter',
        'youtube',
        'linkedin',
        'order_online',
        'open_hours',
    ];
}
