<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Quote;
use App\Models\QuoteItem;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function index(Request $request)
    {
        $quotes = Quote::query()
            ->with(['order'])
            ->withCount('items')
            ->orderByDesc('created_at')
            ->paginate(20)
            ->withQueryString();

        return view('admin.quotes.index', [
            'quotes' => $quotes,
        ]);
    }

    public function show(Quote $quote)
    {
        $quote->load(['items.product', 'order']);

        return view('admin.quotes.show', [
            'quote' => $quote,
        ]);
    }

    public function storeFromOrder(Order $order)
    {
        $order->load(['items.product']);

        $quote = Quote::create([
            'order_id' => $order->id,
            'number' => $this->nextNumber(),
            'status' => 'draft',
            'issued_at' => now()->toDateString(),
            'expires_at' => null,
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
            QuoteItem::create([
                'quote_id' => $quote->id,
                'product_id' => $item->product_id,
                'product_name' => $item->product_name,
                'unit_price' => $item->unit_price,
                'quantity' => $item->quantity,
                'line_total' => $item->line_total,
            ]);
        }

        return redirect()->route('admin.quotes.show', $quote)->with('status', 'Devis créé.');
    }

    public function updateStatus(Request $request, Quote $quote)
    {
        $data = $request->validate([
            'status' => ['required', 'string', 'in:draft,sent,accepted,rejected'],
        ]);

        $quote->update(['status' => $data['status']]);

        return back()->with('status', 'Statut du devis mis à jour.');
    }

    private function nextNumber(): string
    {
        $next = (int) (Quote::query()->max('id') ?? 0) + 1;

        return 'DEV-' . str_pad((string) $next, 6, '0', STR_PAD_LEFT);
    }
}
