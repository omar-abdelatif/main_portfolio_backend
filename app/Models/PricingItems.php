<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricingItems extends Model
{
    protected $fillable = ['pricing_plan_id', 'title'];
    
    public function plan() {
        return $this->belongsTo(Pricing::class, 'pricing_plan_id');
    }
}
