<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::statement("SET foreign_key_checks=0");
        DB::table('roles')->truncate();
        DB::table('styles')->truncate();
        DB::table('roles')->insert([['name'=>'admin'],['name'=>'user']]);
        DB::table('styles')->insert(['header'=>'#ffffff;','site'=>'#ffffff;']);
        DB::statement("SET foreign_key_checks=1");
         $this->getMenu();
         $this->call(UserTableSeeder::class);
         $this->call(ArticlesTableSeeder::class);
        $this->call(SecondArticlesTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->getCategories();
         $this->getDownCat();
         $this->getCatArt();
        $this->getRoleUser();
    }

    public function getRoleUser(){
        $this->truncate('role_user');
        $users=\App\User::all();
        $data=[];
        foreach ($users as $user){
           $data[]=['user_id'=>$user->id,'role_id'=>rand(1,2)];
        }
        DB::table('role_user')->insert($data);

    }

    public function getCatArt(){
        $this->truncate('categories_articles');
        $articles=\App\Article::all();
        $cat=\App\Category::all()->count();
        foreach ($articles as $article){
            DB::table('categories_articles')->insert([
                'category_id'=>rand(1,$cat),
                'article_id'=>$article->id
            ]);
        }

    }

    public function truncate($table){
        DB::statement("SET foreign_key_checks=0");
        DB::table($table)->truncate();
        DB::statement("SET foreign_key_checks=1");
    }

    public function getMenu(){
        $this->truncate('menus');
        DB::table('menus')->insert([
            ['title'=>'Главная','path'=>env('APP_URL'),'parent_id'=>0],
            ['title'=>'Категории','path'=>env('APP_URL'),'parent_id'=>0],
            ['title'=>'Test','path'=>env('APP_URL'),'parent_id'=>0],
            ['title'=>'sub test','path'=>env('APP_URL'),'parent_id'=>3],
            ['title'=>'sub test','path'=>env('APP_URL'),'parent_id'=>3],
            ['title'=>'sub test','path'=>env('APP_URL'),'parent_id'=>3],
            ['title'=>'sub test','path'=>env('APP_URL'),'parent_id'=>3],
            ['title'=>'sub test','path'=>env('APP_URL'),'parent_id'=>3],
            ['title'=>'sub test','path'=>env('APP_URL'),'parent_id'=>6],
            ['title'=>'sub test','path'=>env('APP_URL'),'parent_id'=>6],
            ['title'=>'Контакты','path'=>env('APP_URL'),'parent_id'=>0],
        ]);

    }

    public function  getCategories(){

        $this->truncate('categories');

        DB::table('categories')->insert([

            ['title'=>'Business','parent_id'=>0,'alias'=>'business'],
            ['title'=>'Food','parent_id'=>0,'alias'=>'food'],
            ['title'=>'Transport','parent_id'=>0,'alias'=>'transport'],
            ['title'=>'Sports','parent_id'=>0,'alias'=>'sports'],
            ['title'=>'Cats','parent_id'=>0,'alias'=>'cats'],
            ['title'=>'Fashion','parent_id'=>0,'alias'=>'fashion'],
            ['title'=>'Technics','parent_id'=>0,'alias'=>'technics'],
        ]);

    }

    public function getDownCat(){
        $this->truncate('down_categories');
$article=\App\Article::get()->random()->id;
$category=\App\Category::get()->random()->id;
        DB::table('down_categories')->insert([
            ['category_id'=>$category,'article_id'=>$article,'title'=>'Car','alias'=>'car'],
            ['category_id'=>$category,'article_id'=>$article,'title'=>'Moto','alias'=>'moto'],
            ['category_id'=>$category,'article_id'=>$article,'title'=>'Boats','alias'=>'boats'],
        ]);
}
}
