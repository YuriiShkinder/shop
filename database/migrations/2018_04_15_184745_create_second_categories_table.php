<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSecondCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('second_categories', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');
            $table->string('alias')->unique();
            $table->integer('article_id')->unsigned()->default(1);;
            $table->integer('sale')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('second_categories');
    }
}
