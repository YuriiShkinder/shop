<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DownCategories extends Model
{
    protected $table='down_categories';
    protected $guarded=[];
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function article(){
        return $this->hasOne(Article::class);
    }

}
