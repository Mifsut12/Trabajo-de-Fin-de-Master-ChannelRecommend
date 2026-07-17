<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Canal;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Programa extends Model
{
    protected $table = 'programa';


    public $timestamps = false;
    public function canal(): BelongsTo{
        return $this->belongsTo(Canal::class, 'ID_Canal');
    }

    public function review_programa(){
        return $this->hasMany(review-programa::class);
    }
}
