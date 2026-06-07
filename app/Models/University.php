<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'short_name',
        'logo',
        'banner',
        'description',
        'email',
        'phone',
        'website',
        'country',
        'state',
        'city',
        'address',
        'status',
        'sort_order',
    ];
}
