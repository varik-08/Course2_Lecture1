<?php

namespace App\Providers;

use App\Observers\ProductObserver;
use App\Product;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\User;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Product::observe(ProductObserver::class);

        Blade::directive('user', function ($arguments) {
            $id = $arguments;
            if (strpos($arguments, ',')) {
                list($id, $flag) = explode(',', $arguments);
            }

            $user = User::find($id);
            if(!isset($flag)) {
                $data = "<b>Имя: $user->name, Email: $user->email</b>";
            }
            else {
                switch ($flag)
                {
                    case 'name':
                        $data = "<b>Имя: $user->name</b>";
                        break;
                    case 'email':
                        $data = "<b>Email: $user->email</b>";
                        break;
                }
            }
            return $data;
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
