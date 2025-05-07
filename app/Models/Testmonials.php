<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testmonials extends Model
{
    protected $fillable = [
        'name',
        'image',
        'content',
        'projects_id',
    ];
    public function projects() {
        return $this->belongsTo(Projects::class, 'projects_id');
    }
}
