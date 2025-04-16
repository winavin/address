<?php

namespace Winavin\Address\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class State extends Model
{
    use HasSlug;

    protected $table = "address_states";

    protected $fillable = [
        "country_id",
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

    public function country(): BelongsTo
    {
        return $this->belongsTo(config('address.models.country'));
    }

    public function addresses()
    {
        return $this->hasMany(config('address.models.address'));
    }
}