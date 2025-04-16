<?php

namespace Winavin\Address\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Country extends Model
{
    use HasSlug;

    protected $table = "address_countries";

    protected $fillable = [
        "name",
        "display_name",
        "description",
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('display_name')
            ->saveSlugsTo('name');
    }
    
    public function getRouteKeyName()
    {
        return 'name';
    }

    public function states()
    {
        return $this->hasMany(config('address.models.state'));
    }

    public function addresses()
    {
        return $this->hasMany(config('address.models.address'));
    }
}