<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items'; 
    protected $fillable = [
        'invoice_id',
        'item_name',
        'quantity',
        'single_price',
        'total_amount',
    ];
    protected $casts = [
        'quantity' => 'integer',
        'single_price' => 'decimal:2',
        'total_amount' => 'decimal:2',
    ];
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

}
