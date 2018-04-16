<?php

use Illuminate\Database\Seeder;

class SecondArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table('second_categories')->truncate();
        DB::statement("SET foreign_key_checks=1");
        factory(\App\Second_Categories::class,10)->create();
    }
}
