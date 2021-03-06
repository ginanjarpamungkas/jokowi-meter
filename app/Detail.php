<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model{
    protected $guarded=['id'];
    protected $table = 'detail_promises';

    public function promise()
    {
        return $this->belongsTo(Promise::class);
    }
}
