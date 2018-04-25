<?php
/**
 * Created by PhpStorm.
 * User: yurii
 * Date: 16.04.18
 * Time: 18:56
 */

namespace App\Repositories;

use File;
use App\Article;

class ArticlesRepository extends Repository
{
    public function __construct(Article $article)
    {
        $this->model=$article;
    }


    public function addArticle($request)
    {
        $data = $request->except('_token', 'img','category_id');
        if (empty($data)) {
            return ['error' => 'нет данных'];
        }
        if ($request->hasFile('img')) {
            $image = $request->file('img');

            if ($image->isValid()) {
                $str = str_random(8);
                $obj = new \stdClass();
                $obj->mini = $str . '_mini.jpg';
                $obj->max = $str . '_max.jpg';
                $obj->path = $str . '.jpg';

                $img = \Image::make($image);
                $img->fit(1024, 768)->save(public_path() . '/' . 'pink' . '/images/articles/' . $obj->path);
                $img->fit(600, 400)->save(public_path() . '/' . 'pink' . '/images/articles/' . $obj->max);
                $img->fit(55, 55)->save(public_path() . '/' . 'pink' . '/images/articles/' . $obj->mini);

                $obj->mini=asset('pink').'/images/articles/'. $obj->mini;
                $obj->max=asset('pink').'/images/articles/'. $obj->max;
                $obj->path=asset('pink').'/images/articles/'. $obj->path;

                $data['img'] = json_encode($obj);


            }
        }else{
            $data['img'] = "{\"mini\":\"https:\/\/lorempixel.com\/55\/55\/nature\/?87802\",\"max\":\"https:\/\/lorempixel.com\/816\/282\/animals\/?58262\",\"path\":\"https:\/\/lorempixel.com\/1024\/768\/city\/?26308\"}";
        }
        $this->model->fill($data);

        if ($this->model->save()) {
            $this->model->categories()->attach($request->get('category_id'));
            return ['status' => 'Материал добавлен'];
        }
    }

    public function updateArticle($request , $article)
    {
        $data = $request->except('_method','_token', 'img','category_id','old_image');
        if (empty($data)) {
            return ['error' => 'нет данных'];
        }

        if ($request->hasFile('img')) {
            $image = $request->file('img');

            if ($image->isValid()) {
                $str = str_random(8);
                $obj = new \stdClass();
                $obj->mini = $str . '_mini.jpg';
                $obj->max = $str . '_max.jpg';
                $obj->path = $str . '.jpg';
                $article->img=json_decode($article->img);
                if(!File::exists($article->path)){

                    File::delete($article->path);
                    File::delete($article->mini);
                    File::delete($article->max);

                }

                $img = \Image::make($image);
                $img->fit(1024, 768)->save(public_path() . '/' . 'pink' . '/images/articles/' . $obj->path);
                $img->fit(600, 400)->save(public_path() . '/' . 'pink' . '/images/articles/' . $obj->max);
                $img->fit(55, 55)->save(public_path() . '/' . 'pink' . '/images/articles/' . $obj->mini);

                $obj->mini=asset('pink').'/images/articles/'. $obj->mini;
                $obj->max=asset('pink').'/images/articles/'. $obj->max;
                $obj->path=asset('pink').'/images/articles/'. $obj->path;

                $data['img'] = json_encode($obj);


            }
        }

        $article->fill($data);

        if ($article->update()) {
            $article->categories()->sync($request->get('category_id'));
            return ['status' => 'Материал обновлен'];
        }
    }

    public function  deleteArticle($article){

        $article->comments()->delete();
        $article->img=json_decode($article->img);
        if(!File::exists($article->path)){

            File::delete($article->path);
            File::delete($article->mini);
            File::delete($article->max);

        }

        if($article->delete()){

            return ['status'=>'Материал удален'];
        }
    }

    public function one($alias,$attr=[]){
        return $this->model->where('id',$alias)->paginate(2);
    }




}