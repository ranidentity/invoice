<?php

namespace App\Interfaces;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Collection;

interface OrderItemRepositoryInterface
{
    public function createOrderItem(array $itemDetails): OrderItem;
    public function updateOrderItem(int $itemId, array $itemDetails): bool;
    public function deleteOrderItems(array $itemIds): int; // Returns number of deleted items
    public function getItemsByInvoiceId(int $invoiceId): Collection;
}