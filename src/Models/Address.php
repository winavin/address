<?php

namespace Winavin\Address\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Address extends Model
{
    protected $table = "address_addresses";

    protected $fillable = [
        "addressable_type",
        "addressable_id",
        "type",
        "display_name",
        "contact_person",
        "name",
        "email",
        "mobile",
        "line_1",
        "line_2",
        "city",
        "district",
        "state_id",
        "country_id",
        "postal_code",
        "is_default",
        "is_billing",
        "is_default_billing",
        "is_shipping",
        "is_default_shipping",
        "is_pickup",
        "is_default_pickup",
    ];

    public function owner(): MorphTo
    {
        return $this->morphTo("addressable");
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(config("address.models.state"));
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(config("address.models.country"));
    }

    public function toString(): string
    {
        return collect([
            $this->line_1,
            $this->line_2,
            $this->city,
            $this->district,
            $this->state?->name,
            $this->country?->name,
            $this->postal_code,
        ])->filter()->implode(', ');       
    }
}