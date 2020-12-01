<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['user_id','url','ancho','largo'];

        //relacion de uno a muchos inversa
        public function user()
        {
            return $this->belongsTo('App\User');
        }
}
