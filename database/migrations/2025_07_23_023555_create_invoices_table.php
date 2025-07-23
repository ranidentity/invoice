<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->string('invoice_description');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('billing_address');
            $table->string('billing_city');
            $table->string('billing_postal_code');
            $table->string('billing_country');
            $table->decimal('total_amount', 10, 2);
            $table->date('due_date');
            $table->date('invoice_date');
            $table->string('status')->default('pending');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
