<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Notifications\AdminOrderPlacedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class CartController extends Controller
{
    public function index()
    {
        $cartData = $this->getCartData();

        $suggestedProducts = Product::query()
            ->active()
            ->ordered()
            ->take(3)
            ->get();

        return view('cart.index', $cartData + compact('suggestedProducts'));
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity' => ['nullable', 'integer', 'min:1', 'max:10'],
            'redirect_to' => ['nullable', 'string'],
        ]);

        $product = Product::findOrFail($validated['product_id']);
        $qty = (int) ($validated['quantity'] ?? 1);

        $cart = $this->getCart();
        $currentQty = (int) ($cart[$product->id]['quantity'] ?? 0);
        $cart[$product->id] = [
            'product_id' => $product->id,
            'quantity' => min(10, $currentQty + $qty),
        ];

        $this->putCart($cart);

        $redirectTo = $validated['redirect_to'] ?? null;
        if ($redirectTo === 'shipping') {
            return redirect()->route('cart.shipping')->with('success', 'Produit ajouté au panier.');
        }

        return redirect()->route('cart.index')->with('success', 'Produit ajouté au panier.');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'integer'],
            'quantity' => ['required', 'integer', 'min:1', 'max:10'],
        ]);

        $cart = $this->getCart();
        $productId = (int) $validated['product_id'];

        if (!isset($cart[$productId])) {
            return redirect()->route('cart.index');
        }

        $cart[$productId]['quantity'] = (int) $validated['quantity'];
        $this->putCart($cart);

        return redirect()->route('cart.index')->with('success', 'Quantité mise à jour.');
    }

    public function remove(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'integer'],
        ]);

        $cart = $this->getCart();
        $productId = (int) $validated['product_id'];

        unset($cart[$productId]);
        $this->putCart($cart);

        return redirect()->route('cart.index')->with('success', 'Produit supprimé du panier.');
    }

    public function shipping()
    {
        $cartData = $this->getCartData();
        return view('cart.shipping', $cartData);
    }

    public function storeShipping(Request $request)
    {
        $validated = $request->validate([
            'lastname' => ['required', 'string', 'max:255'],
            'firstnames' => ['required', 'string', 'max:255'],
            'whatsapp' => ['required', 'string', 'max:50'],
            'phone' => ['nullable', 'string', 'max:50'],
            'delivery_place' => ['required', 'string', 'max:255'],
            'delivery_day' => ['nullable', 'date'],
            'details' => ['nullable', 'string'],
            'shipping_method' => ['required', 'string'],
        ]);

        session()->put('checkout.shipping', $validated);

        $cart = $this->getCart();
        if (count($cart) === 0) {
            return redirect()->route('cart.index');
        }

        $cartData = $this->getCartData();
        $shippingData = session()->get('checkout.shipping', []);

        $order = DB::transaction(function () use ($shippingData, $cartData) {
            $order = Order::create([
                'user_id' => Auth::id(),
                'status' => 'pending',
                'payment_method' => null,
                'shipping_method' => $shippingData['shipping_method'] ?? null,
                'lastname' => $shippingData['lastname'],
                'firstnames' => $shippingData['firstnames'],
                'whatsapp' => $shippingData['whatsapp'],
                'phone' => $shippingData['phone'] ?? null,
                'delivery_place' => $shippingData['delivery_place'],
                'delivery_day' => $shippingData['delivery_day'] ?? null,
                'details' => $shippingData['details'] ?? null,
                'subtotal' => $cartData['subtotal'],
                'shipping_amount' => $cartData['shipping'],
                'total' => $cartData['total'],
            ]);

            foreach ($cartData['cartItems'] as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->id,
                    'product_name' => $item->name,
                    'unit_price' => $item->price,
                    'quantity' => $item->quantity,
                    'line_total' => $item->price * $item->quantity,
                ]);
            }

            return $order;
        });

        $admins = User::query()
            ->where('is_admin', true)
            ->where('is_active', true)
            ->whereNotNull('email')
            ->get();

        if ($admins->isNotEmpty()) {
            Notification::send($admins, new AdminOrderPlacedNotification($order));
        }

        session()->forget('cart');
        session()->forget('checkout.shipping');

        return redirect()->route('cart.confirmation', $order)->with('success', 'Commande enregistrée avec succès.');
    }

    public function payment()
    {
        return redirect()->route('cart.shipping');
    }

    public function placeOrder(Request $request)
    {
        return redirect()->route('cart.shipping');
    }

    public function confirmation(Order $order)
    {
        $items = $order->items()->get();

        $productIds = $items
            ->pluck('product_id')
            ->filter()
            ->map(fn ($id) => (int) $id)
            ->values()
            ->all();

        $products = Product::query()
            ->whereIn('id', $productIds)
            ->get()
            ->keyBy('id');

        $cartItems = $items->map(function ($item) use ($products) {
            $product = null;
            if ($item->product_id) {
                $product = $products->get((int) $item->product_id);
            }

            return (object) [
                'id' => $item->product_id,
                'name' => $item->product_name,
                'slug' => $product?->slug,
                'image' => $product?->image ? asset($product->image) : null,
                'price' => $item->unit_price,
                'old_price' => null,
                'quantity' => $item->quantity,
                'options' => null,
            ];
        });

        $subtotal = (float) $order->subtotal;
        $savings = 0;
        $shipping = (float) $order->shipping_amount;
        $total = (float) $order->total;

        return view('cart.confirmation', compact('order', 'cartItems', 'subtotal', 'savings', 'shipping', 'total'));
    }

    private function getCartData()
    {
        $cart = $this->getCart();
        $productIds = array_map('intval', array_keys($cart));

        $products = Product::query()
            ->whereIn('id', $productIds)
            ->get()
            ->keyBy('id');

        $cartItems = collect($productIds)
            ->filter(fn ($id) => $products->has($id))
            ->map(function ($id) use ($products, $cart) {
                $product = $products[$id];
                $quantity = (int) ($cart[$id]['quantity'] ?? 1);

                return (object) [
                    'id' => $product->id,
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'image' => asset($product->image),
                    'price' => (float) $product->price,
                    'shipping_price' => (float) ($product->shipping_price ?? 0),
                    'old_price' => $product->old_price ? (float) $product->old_price : null,
                    'quantity' => $quantity,
                    'options' => null,
                ];
            });

        $subtotal = $cartItems->sum(fn($item) => $item->price * $item->quantity);
        $savings = $cartItems->sum(fn($item) => $item->old_price ? ($item->old_price - $item->price) * $item->quantity : 0);

        $shipping = 0;
        $usesProductShipping = \Illuminate\Support\Facades\Schema::hasColumn('products', 'shipping_price');
        if ($usesProductShipping) {
            $shipping = (float) $cartItems
                ->map(fn ($item) => (float) ($item->shipping_price ?? 0))
                ->max();
        }

        $shippingData = session()->get('checkout.shipping');
        if (is_array($shippingData) && ($shippingData['shipping_method'] ?? null) === 'express') {
            $shipping += 5000;
        }

        $total = $subtotal + $shipping;

        return compact('cartItems', 'subtotal', 'savings', 'shipping', 'total', 'usesProductShipping');
    }

    private function getCart(): array
    {
        $cart = session()->get('cart', []);
        return is_array($cart) ? $cart : [];
    }

    private function putCart(array $cart): void
    {
        session()->put('cart', $cart);
    }
}
