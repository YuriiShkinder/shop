<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table='categories';
    protected $guarded=[];

    public function down(){
        return $this->hasMany(DownCategories::class,'category_id');
    }

    public function articles(){
        return $this->belongsToMany(Article::class,'categories_articles');
    }
}
