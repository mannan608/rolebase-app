<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    protected $fillable = [
        'university_id',
        'name',
        'slug',
        'email',
        'phone',
        'country',
        'state',
        'city',
        'address',
        'description',
        'status',
        'sort_order',
    ];
    public function university()
    {
        return $this->belongsTo(University::class);
    }
    public function campuses()
    {
        return $this->hasMany(Campus::class);
    }
}
