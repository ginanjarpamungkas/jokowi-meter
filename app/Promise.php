<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promise extends Model{
    protected $guarded=['id'];

    public function detail(){
        return $this->hasMany(Detail::class,'promise_id');
    }
}
