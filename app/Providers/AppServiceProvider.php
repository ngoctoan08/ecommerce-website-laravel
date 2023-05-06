<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
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
        //
        Schema::defaultStringLength(191);
        
        Blade::directive('formatMoney', function ($money) {
            return "<?php echo number_format($money, 0) . ' VNĐ'; ?>";
});

Blade::directive('checkStatusOrdered', function ($status) {
return "<?= $status == 1 ? 'Đang xử lý' : 'Đã hoàn thành' ?>";
});

Blade::directive('cssStatusOrdered', function ($status) {
return "<?= $status == 1 ? 'status--denied' : 'status--process' ?>";
});
}
}