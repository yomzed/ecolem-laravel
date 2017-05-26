<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function robots()
    {
    	return $this->belongsToMany(Robot::class);
    }
}
