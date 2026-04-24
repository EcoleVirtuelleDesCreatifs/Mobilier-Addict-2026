<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Order;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $invoices = Invoice::query()
            ->with(['order'])
            ->withCount('items')
            ->orderByDesc('created_at')
            ->paginate(20)
            ->withQueryString();

        return view('admin.invoices.index', [
            'invoices' => $invoices,
        ]);
    }

    public function show(Invoice $invoice)
    {
        $invoice->load(['items.product', 'order']);

        return view('admin.invoices.show', [
            'invoice' => $invoice,
        ]);
    }

    public function storeFromOrder(Order $order)
    {
        $order->load(['items.product']);

        $invoice = Invoice::create([
            'order_id' => $order->id,
            'number' => $this->nextNumber(),
            'status' => 'draft',
            'issued_at' => now()->toDateString(),
            'due_at' => null,
            'paid_at' => null,
            'lastname' => $order->lastname,
            'firstnames' => $order->firstnames,
            'whatsapp' => $order->whatsapp,
            'phone' => $order->phone,
            'delivery_place' => $order->delivery_place,
            'delivery_day' => $order->delivery_day,
            'details' => $order->details,
            'subtotal' => $order->subtotal ?? 0,
            'shipping_amount' => $order->shipping_amount ?? 0,
            'total' => $order->total ?? 0,
            'notes' => null,
        ]);

        foreach ($order->items as $item) {
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'product_id' => $item->product_id,
                'product_name' => $item->product_name,
                'unit_price' => $item->unit_price,
                'quantity' => $item->quantity,
                'line_total' => $item->line_total,
            ]);
        }

        return redirect()->route('admin.invoices.show', $invoice)->with('status', 'Facture créée.');
    }

    public function updateStatus(Request $request, Invoice $invoice)
    {
        $data = $request->validate([
            'status' => ['required', 'string', 'in:draft,sent,paid,canceled'],
        ]);

        $update = ['status' => $data['status']];

        if ($data['status'] === 'paid' && !$invoice->paid_at) {
            $update['paid_at'] = now()->toDateString();
        }

        if ($data['status'] !== 'paid') {
            $update['paid_at'] = null;
        }

        $invoice->update($update);

        return back()->with('status', 'Statut de la facture mis à jour.');
    }

    public function downloadPdf(Invoice $invoice)
    {
        $invoice->load(['items.product', 'order']);

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $html = view('admin.invoices.pdf', ['invoice' => $invoice])->render();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf->stream('facture-' . $invoice->number . '.pdf');
    }

    private function nextNumber(): string
    {
        $next = (int) (Invoice::query()->max('id') ?? 0) + 1;

        return 'FAC-' . str_pad((string) $next, 6, '0', STR_PAD_LEFT);
    }
}
