<?php

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table('articles')->truncate();
        DB::statement("SET foreign_key_checks=1");

        factory('App\Article', 150)->create();
    }
}
