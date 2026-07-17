<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class review_programa extends Model
{

    protected $table = 'reviews-programa';
    public function review(){
        return $this->belongsTo(review::class, 'ID_Review');
    }

    public function programa(){
        return $this->belongsTo(Programa::class, 'ID_Programa');
    }


    
}
