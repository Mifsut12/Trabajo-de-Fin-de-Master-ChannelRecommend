<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Canal extends Model
{
    protected $table = 'canales';


    public function canal(){
        return $this->hasMany(Programa::class, 'ID_Canal');
    }
}
