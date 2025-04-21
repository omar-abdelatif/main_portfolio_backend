<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethods extends Model
{
    protected $fillable = [
        'methods_name',
        'methods_icon',
        'methods_status',
        'methods_value',
    ];
}
