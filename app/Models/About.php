<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $table = 'about';
    protected $fillable = ['name', 'email', 'position', 'nationality', 'phone', 'about_img', 'about_cv', 'description'];
}
