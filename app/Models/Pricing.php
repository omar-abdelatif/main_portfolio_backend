<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
    protected $fillable = ['name', 'price', 'currency'];
    public function items() {
        return $this->hasMany(PricingItems::class, 'pricing_plan_id');
    }
}
