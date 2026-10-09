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
            ->when($request->filled('q'), function ($query) use ($request) {
                $q = trim((string) $request->input('q'));
                $query->where(function ($sub) use ($q) {
                    $sub->where('number', 'like', "%{$q}%")
                        ->orWhere('lastname', 'like', "%{$q}%")
                        ->orWhere('firstnames', 'like', "%{$q}%")
                        ->orWhere('company_name', 'like', "%{$q}%")
                        ->orWhere('whatsapp', 'like', "%{$q}%")
                        ->orWhere('email', 'like', "%{$q}%");
                });
            })
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->input('status')))
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
            'products' => \App\Models\Product::query()->active()->ordered()->get(['id', 'name', 'price', 'image']),
        ]);
    }

    public function update(Request $request, Quote $quote)
    {
        $data = $request->validate([
            'status' => ['nullable', 'string', 'in:pending,draft,sent,accepted,rejected'],
            'shipping_amount' => ['nullable', 'numeric', 'min:0'],
            'expires_at' => ['nullable', 'date'],
            'notes' => ['nullable', 'string', 'max:5000'],
        ]);

        $quote->fill([
            'status' => $data['status'] ?? $quote->status,
            'shipping_amount' => $data['shipping_amount'] ?? 0,
            'expires_at' => $data['expires_at'] ?? null,
            'notes' => $data['notes'] ?? null,
        ]);
        $this->recalcTotals($quote);
        $quote->save();

        return back()->with('status', 'Devis mis à jour.');
    }

    public function addItem(Request $request, Quote $quote)
    {
        $data = $request->validate([
            'product_id' => ['nullable', 'integer', 'exists:products,id'],
            'custom_name' => ['nullable', 'string', 'max:255', 'required_without:product_id'],
            'quantity' => ['required', 'integer', 'min:1', 'max:9999'],
            'unit_price' => ['nullable', 'numeric', 'min:0'],
        ], [
            'custom_name.required_without' => 'Choisissez un produit ou saisissez une désignation.',
        ]);

        $product = !empty($data['product_id']) ? \App\Models\Product::find($data['product_id']) : null;
        $unitPrice = $data['unit_price'] !== null && $data['unit_price'] !== ''
            ? (float) $data['unit_price']
            : (float) ($product->price ?? 0);

        QuoteItem::create([
            'quote_id' => $quote->id,
            'product_id' => $product?->id,
            'product_name' => $product?->name ?? trim((string) $data['custom_name']),
            'unit_price' => $unitPrice,
            'quantity' => (int) $data['quantity'],
            'line_total' => $unitPrice * (int) $data['quantity'],
        ]);

        $this->recalcTotals($quote);
        $quote->save();

        return back()->with('status', 'Article ajouté au devis.');
    }

    public function removeItem(Quote $quote, QuoteItem $item)
    {
        abort_unless((int) $item->quote_id === (int) $quote->id, 404);
        $item->delete();

        $this->recalcTotals($quote);
        $quote->save();

        return back()->with('status', 'Article retiré du devis.');
    }

    public function destroy(Quote $quote)
    {
        $quote->items()->delete();
        $quote->delete();

        return redirect()->route('admin.quotes.index')->with('status', 'Devis supprimé.');
    }

    private function recalcTotals(Quote $quote): void
    {
        $subtotal = (float) $quote->items()->sum('line_total');
        $quote->subtotal = $subtotal;
        $quote->total = $subtotal + (float) ($quote->shipping_amount ?? 0);
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
            'status' => ['required', 'string', 'in:pending,draft,sent,accepted,rejected'],
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
