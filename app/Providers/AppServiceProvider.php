<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Schema;
use DB;
use Blade;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('set',function ($exp){
            list($name,$val)=explode(',',$exp);
            return "<?php $name=$val ?>";
        });


        Schema::defaultStringLength(191);
        DB::listen(function ($query){
            // dump($query->sql);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
