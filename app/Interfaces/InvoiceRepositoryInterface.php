<?php

namespace App\Interfaces;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Collection;

interface InvoiceRepositoryInterface
{
    public function getAllInvoices(): Collection;
    public function getInvoiceById(int $invoiceId): ?Invoice;
    public function createInvoice(array $invoiceDetails, array $itemDetails): Invoice;
    public function updateInvoice(int $invoiceId, array $invoiceDetails, array $itemDetails): Invoice;
    public function deleteInvoice(int $invoiceId): bool;
    public function getTrashedInvoices(): Collection;
}