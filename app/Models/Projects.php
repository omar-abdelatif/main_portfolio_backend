<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'link',
        'tags',
        'image',
        'category',
        'github_url',
        'description',
        'subcategory',
        'categories_id',
    ];
    public function categories() {
        return $this->belongsTo(Categories::class, 'categories_id');
    }
    public function testmonials() {
        return $this->hasOne(Testmonials::class, 'projects_id');
    }
}
