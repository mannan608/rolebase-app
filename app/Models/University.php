<?php

namespace App\Models;

use App\SEO\Models\SeoMeta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Str;

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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($university) {
            if (empty($university->slug)) {
                $university->slug = Str::slug($university->name);
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
