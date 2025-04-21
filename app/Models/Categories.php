<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = [
        'name',
        'slug'
    ];

    public function projects() {
        return $this->hasMany(Projects::class, 'categories_id', 'id');
    }
}