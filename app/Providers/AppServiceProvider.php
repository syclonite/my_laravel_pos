<?php

namespace App\Providers;

use App\Models\StockCount;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
            $countStock = StockCount::where('total_quantity', '<=',10)->count();
            $stock_result = StockCount::where('total_quantity', '<=',10)->get();
            View::share(compact('countStock','stock_result'));
    }
}
