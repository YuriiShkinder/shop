<?php
/**
 * Created by PhpStorm.
 * User: yurii
 * Date: 20.04.18
 * Time: 18:04
 */

namespace App\Repositories;

use File;
use App\User;

class UserRepository extends Repository
{
    public function __construct(User $user)
    {
        $this->model=$user;
    }

    public function updateUser($request, $user)
    {

        $data = $request->except('_token', 'img','old_image');

        if (empty($data)) {
            return ['error' => 'нет данных'];
        }

        if ($request->hasFile('img')) {
            $image = $request->file('img');

            if ($image->isValid()) {

                File::delete(public_path('pink/images/users/').array_last(explode('/',$user->img)));

                $str=str_random(8).'.jpg';
                $img = \Image::make($image);

                $img->fit(200, 300)->save(public_path() . '/' . env('THEME') . '/images/users/' . $str);
                $data['img'] =asset(env('THEME')).'/images/users/'. $str;
            }
        }

        if ($user->update($data)) {
            return ['status' => 'Материал обновлен'];
        }
    }

}