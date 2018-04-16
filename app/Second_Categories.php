<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Second_Categories extends Model
{
    protected $table='second_categories';
    protected $guarded=[];

    public function article(){
        return $this->belongsTo(Article::class);
    }
}
