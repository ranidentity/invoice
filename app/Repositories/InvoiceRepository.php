<?php

namespace App\Repositories;

use App\Interfaces\InvoiceRepositoryInterface;
use App\Interfaces\OrderItemRepositoryInterface;
use App\Models\Invoice;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB; // For transactions within the repository

class InvoiceRepository implements InvoiceRepositoryInterface
{
    protected OrderItemRepositoryInterface $orderItemRepository;

    public function __construct(OrderItemRepositoryInterface $orderItemRepository)
    {
        $this->orderItemRepository = $orderItemRepository;
    }

    public function getAllInvoices(): Collection
    {
        return Invoice::orderBy('created_at', 'desc')->get();
    }

    public function getInvoiceById(int $invoiceId): ?Invoice
    {
        return Invoice::with('orderItems')->find($invoiceId);
    }

    public function createInvoice(array $invoiceDetails, array $itemDetails): Invoice
    {
        // Calculate total_amount based on itemDetails
        $totalAmount = 0;
        foreach ($itemDetails as $item) {
            $totalAmount += (float)$item['quantity'] * (float)$item['single_price'];
        }
        $invoiceDetails['total_amount'] = $totalAmount;

        return DB::transaction(function () use ($invoiceDetails, $itemDetails) {
            $invoice = Invoice::create($invoiceDetails);

            foreach ($itemDetails as $itemData) {
                $itemData['invoice_id'] = $invoice->id;
                $itemData['total_amount'] = (float)$itemData['quantity'] * (float)$itemData['single_price'];
                $this->orderItemRepository->createOrderItem($itemData);
            }
            return $invoice;
        });
    }

    public function updateInvoice(int $invoiceId, array $invoiceDetails, array $itemDetails): Invoice
    {
        $invoice = Invoice::with('orderItems')->findOrFail($invoiceId);

        $newTotalAmount = 0;
        foreach ($itemDetails as $item) {
            $newTotalAmount += (float)$item['quantity'] * (float)$item['single_price'];
        }
        $invoiceDetails['total_amount'] = $newTotalAmount;

        DB::transaction(function () use ($invoice, $invoiceDetails, $itemDetails) {
            $invoice->update($invoiceDetails);

            $existingItemIds = $invoice->orderItems->pluck('id')->toArray();
            $submittedItemIds = collect($itemDetails)->pluck('id')->filter()->toArray();

            $itemsToDelete = array_diff($existingItemIds, $submittedItemIds);
            if (!empty($itemsToDelete)) {
                $this->orderItemRepository->deleteOrderItems($itemsToDelete);
            }

            foreach ($itemDetails as $itemData) {
                $itemData['invoice_id'] = $invoice->id;
                $itemData['total_amount'] = (float)$itemData['quantity'] * (float)$itemData['single_price'];

                if (isset($itemData['id']) && in_array($itemData['id'], $existingItemIds)) {
                    $this->orderItemRepository->updateOrderItem($itemData['id'], $itemData);
                } else {
                    $this->orderItemRepository->createOrderItem($itemData);
                }
            }
        });
        return $invoice->fresh('orderItems');
    }

    public function deleteInvoice(int $invoiceId): bool
    {
        $invoice = Invoice::findOrFail($invoiceId);

        return DB::transaction(function () use ($invoice) {
            $this->orderItemRepository->deleteOrderItems($invoice->orderItems->pluck('id')->toArray());
            return $invoice->delete();
        });
    }

    public function getTrashedInvoices(): Collection
    {
        return Invoice::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
    }
}