<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController; 

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('invoices')->group(function () {
    Route::post('/', [InvoiceController::class, 'store']); // POST /api/invoices (Create new invoice via API)

    Route::put('{invoice}', [InvoiceController::class, 'update']);    // PUT /api/invoices/{id} (Update invoice via API)
    Route::delete('{invoice}', [InvoiceController::class, 'destroy']); // DELETE /api/invoices/{id} (Delete invoice via API)
});
