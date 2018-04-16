<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $guarded=[];

    public function categories(){
        return $this->belongsToMany(Category::class,'categories_articles');
    }

    public function second(){
        return $this->hasMany(Second_Categories::class,'article_id','id');
    }

    public function down(){
        return $this->hasMany(DownCategories::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }


}
