<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'invoice_number',
        'invoice_description',
        'customer_name',
        'customer_email',
        'billing_address',
        'billing_city',
        'billing_postal_code',
        'billing_country',
        'total_amount',
        'due_date',
        'invoice_date',
        'status',
    ];
    protected $casts = [
        'due_date' => 'date',
        'invoice_date' => 'date',
        'total_amount' => 'decimal:2', 
    ];
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

}
