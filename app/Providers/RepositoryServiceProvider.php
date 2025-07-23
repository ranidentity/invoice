<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\InvoiceRepositoryInterface;
use App\Repositories\InvoiceRepository;
use App\Interfaces\OrderItemRepositoryInterface;
use App\Repositories\OrderItemRepository;
use Illuminate\Support\Facades\Log;

class RepositoryServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        // Bind Invoice Repository
        $this->app->bind(
            InvoiceRepositoryInterface::class,
            InvoiceRepository::class
        );

        // Bind Order Item Repository
        $this->app->bind(
            OrderItemRepositoryInterface::class,
            OrderItemRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        
    }
}