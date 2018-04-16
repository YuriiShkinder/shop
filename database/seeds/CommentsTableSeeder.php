<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table('comments')->truncate();
        DB::statement("SET foreign_key_checks=1");
        factory('App\Comment',50)->create();
    }
}
