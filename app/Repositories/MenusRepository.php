<?php
/**
 * Created by PhpStorm.
 * User: yurii
 * Date: 16.04.18
 * Time: 18:56
 */

namespace App\Repositories;


use App\Menu;

class MenusRepository extends Repository
{
    public function __construct(Menu $menu)
    {
        $this->model=$menu;
    }
}