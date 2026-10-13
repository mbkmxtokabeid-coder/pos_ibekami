<?php

namespace App\Providers;

use App\Models\Spk;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Observers\SPKObserver;

use App\Models\Penjualan;
use App\Models\Pembelian;
use Illuminate\Support\Facades\Cache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Spk::observe(SPKObserver::class);
        Schema::defaultStringLength(191);

        Penjualan::saved(function () {
            Cache::forget('dashboard_page_data_cache');
        });
        Penjualan::deleted(function () {
            Cache::forget('dashboard_page_data_cache');
        });
        Pembelian::saved(function () {
            Cache::forget('dashboard_page_data_cache');
        });
        Pembelian::deleted(function () {
            Cache::forget('dashboard_page_data_cache');
        });
    }
}
