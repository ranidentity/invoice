<?php

namespace App\Http\Controllers;
use App\Interfaces\InvoiceRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

use function Illuminate\Log\log;

class InvoiceController extends Controller
{
    protected InvoiceRepositoryInterface $invoiceRepository;
    public function __construct(InvoiceRepositoryInterface $invoiceRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
    }

    public function index()
    {
        $invoices = $this->invoiceRepository->getAllInvoices();
        // return view('invoices.index', compact('invoices'));
        return Inertia::render('invoices/Dashboard', ['invoices'=>$invoices]);
    }

    public function create()
    {
        return view('invoices.create');
    }

    public function store(Request $request)
    {
        $invoiceValidatedData = $request->validate([
            'invoice_number'      => 'required|string|unique:invoices|max:255',
            'invoice_description' => 'nullable|string|max:255',
            'customer_name'       => 'required|string|max:255',
            'customer_email'      => 'required|email:rfc,dns|max:255',
            'billing_address'     => 'required|string|max:255',
            'billing_city'        => 'required|string|max:255',
            'billing_postal_code' => 'required|string|max:20',
            'billing_country'     => 'required|string|max:255',
            'invoice_date'        => 'required|date',
            'due_date'            => 'required|date|after_or_equal:invoice_date',
            'invoice_address'     => 'required|string|max:255', 
            'status'              => 'required|in:pending,paid,overdue,draft',
        ]);

        $request->validate([
            'items'                     => 'required|array|min:1',
            'items.*.item_name'         => 'required|string|max:255',
            'items.*.quantity'          => 'required|integer|min:1',
            'items.*.single_price'      => 'required|numeric|min:0.01',
        ]);

        $this->invoiceRepository->createInvoice($invoiceValidatedData, $request->items);

        return redirect()->route('invoices.index')->with('success', 'Invoice created successfully!');
    }
    public function show(int $invoiceId)
    {
        $invoice = $this->invoiceRepository->getInvoiceById($invoiceId);
        if (!$invoice) {
            abort(404); // Or redirect with an error message
        }
        return view('invoices.show', compact('invoice'));
    }
    public function edit(int $invoiceId)
    {
        $invoice = $this->invoiceRepository->getInvoiceById($invoiceId);
        if (!$invoice) {
            abort(404);
        }
        return view('invoices.edit', compact('invoice'));
    }

    public function update(Request $request, int $invoiceId)
    {
        // 1. Validate Invoice Master Data
        $invoiceValidatedData = $request->validate([
            'invoice_number'      => [
                'required',
                'string',
                'max:255',
                Rule::unique('invoices')->ignore($invoiceId), // Allow current invoice's number
            ],
            'invoice_description' => 'nullable|string|max:255',
            'customer_name'       => 'required|string|max:255',
            'customer_email'      => 'required|email:rfc,dns|max:255',
            'billing_address'     => 'required|string|max:255',
            'billing_city'        => 'required|string|max:255',
            'billing_postal_code' => 'required|string|max:20',
            'billing_country'     => 'required|string|max:255',
            'invoice_date'        => 'required|date',
            'due_date'            => 'required|date|after_or_equal:invoice_date',
            'invoice_address'     => 'required|string|max:255',
            'status'              => 'required|in:pending,paid,overdue,draft',
        ]);

        // 2. Validate Order Items Data
        // 'items' can be empty if all items are removed from the form, but individual items must be valid if present.
        $request->validate([
            'items'                     => 'nullable|array',
            'items.*.id'                => 'nullable|exists:order_items,id', // For existing items (must exist in DB)
            'items.*.item_name'         => 'required|string|max:255',
            'items.*.quantity'          => 'required|integer|min:1',
            'items.*.single_price'      => 'required|numeric|min:0.01',
        ]);

        $invoice = $this->invoiceRepository->updateInvoice($invoiceId, $invoiceValidatedData, $request->items ?? []);

        return response()->json($invoice);
        // return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully!');
    }
    public function destroy(int $invoiceId)
    {
        $this->invoiceRepository->deleteInvoice($invoiceId);
        return redirect()->route('invoices.index')->with('success', 'Invoice deleted successfully!');
    }
    public function trashed()
    {
        $trashedInvoices = $this->invoiceRepository->getTrashedInvoices();
        return view('invoices.trashed', compact('trashedInvoices'));
    }

}
