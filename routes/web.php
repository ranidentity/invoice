<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\InvoiceController; // Make sure to import your controller

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

Route::prefix('invoice')->group(function(){
    Route::get('/', [InvoiceController::class,'index'])->name('invoices.list'); // Exclude show for now if using a custom route below or vue handled
    Route::get('create', [InvoiceController::class,'create'])->name('invoices.create'); // Exclude show for now if using a custom route below or vue handled
    Route::get('{invoice}', [InvoiceController::class, 'show'])->name('invoices.show');
    Route::get('trashed', [InvoiceController::class, 'trashed'])->name('invoices.trashed');
});