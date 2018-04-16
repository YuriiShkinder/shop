<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table('orders')->truncate();

        DB::statement("SET foreign_key_checks=1");
        factory('App\Order', 40)->create();
    }
}
