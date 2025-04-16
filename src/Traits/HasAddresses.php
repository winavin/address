<?php
  
namespace Winavin\Address\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasAddresses
{
    public function addresses(): MorphMany
    {
        return $this->morphMany(config('address.models.address'), 'addressable');
    }

    public function defaultAddress(): MorphOne
    {
        return $this->morphOne(config('address.models.address'), 'addressable')->where("is_default", true);
    }

    public function defaultBillingAddress(): MorphOne
    {
        return $this->morphOne(config('address.models.address'), 'addressable')->where("is_default_billing", true);
    }

    public function defaultShippingAddress(): MorphOne
    {
        return $this->morphOne(config('address.models.address'), 'addressable')->where("is_default_shipping", true);
    }
}