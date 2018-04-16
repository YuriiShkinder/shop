<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table('users')->truncate();

        DB::statement("SET foreign_key_checks=1");
        factory('App\User', 20)->create();
    }
}
