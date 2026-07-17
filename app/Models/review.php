<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\review_programa;

class review extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function review_programa(){
        return $this->hasMany(review_programa::class);
    }

    public $timestamps = false;
}
