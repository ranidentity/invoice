<?php

namespace App\Repositories;

use App\Interfaces\OrderItemRepositoryInterface;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Collection;

class OrderItemRepository implements OrderItemRepositoryInterface
{
    public function createOrderItem(array $itemDetails): OrderItem
    {
        return OrderItem::create($itemDetails);
    }

    public function updateOrderItem(int $itemId, array $itemDetails): bool
    {
        return OrderItem::where('id', $itemId)->update($itemDetails);
    }

    public function deleteOrderItems(array $itemIds): int
    {
        // If OrderItem model uses SoftDeletes, this will soft delete. Otherwise, hard delete.
        return OrderItem::destroy($itemIds);
    }

    public function getItemsByInvoiceId(int $invoiceId): Collection
    {
        return OrderItem::where('invoice_id', $invoiceId)->get();
    }

    public function restoreOrderItemsByInvoiceId(int $invoiceId): int
    {
        // This assumes OrderItem model uses SoftDeletes
        return OrderItem::onlyTrashed()
                         ->where('invoice_id', $invoiceId)
                         ->restore();
    }
}