<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\InvoiceRepositoryInterface;
use App\Repositories\InvoiceRepository;
use App\Interfaces\OrderItemRepositoryInterface;
use App\Repositories\OrderItemRepository;
use Illuminate\Support\Facades\Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
