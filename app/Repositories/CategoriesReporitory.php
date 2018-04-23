<?php
/**
 * Created by PhpStorm.
 * User: yurii
 * Date: 17.04.18
 * Time: 22:29
 */

namespace App\Repositories;


use App\Category;
use Validator;
class CategoriesReporitory extends Repository
{
    public function __construct(Category $category)
    {
        $this->model=$category;
    }

    public function one($alias, $attr = [])
    {
        $category= parent::one($alias, $attr);
        if ($category && !empty($attr)) {

            $category->load('articles','down');
        }

        return $category;

    }

    public function deleteCategory($category){

        if($category->delete()){
            return ['status'=>'Сылка удалена'];
        }
    }



}