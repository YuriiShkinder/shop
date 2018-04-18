<?php
/**
 * Created by PhpStorm.
 * User: yurii
 * Date: 17.04.18
 * Time: 22:29
 */

namespace App\Repositories;


use App\Category;

class CategoriesReporitory extends Repository
{
    public function __construct(Category $category)
    {
        $this->model=$category;
    }

}