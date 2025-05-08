<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectGallery extends Model
{
    protected $fillable = [
        'image',
        'projects_id',
    ];
    public function projects() {
        return $this->belongsTo(Projects::class, 'projects_id');
    }
}
