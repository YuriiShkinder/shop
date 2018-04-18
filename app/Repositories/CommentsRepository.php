<?php
/**
 * Created by PhpStorm.
 * User: yurii
 * Date: 18.04.18
 * Time: 20:49
 */

namespace App\Repositories;


use App\Comment;

class CommentsRepository extends Repository
{
public function __construct(Comment $comment)
{
    $this->model=$comment;
}
}