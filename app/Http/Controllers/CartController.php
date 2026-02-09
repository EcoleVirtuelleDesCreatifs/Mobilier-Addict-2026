<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\User;
use App\Notifications\AdminCartItemAddedNotification;
use App\Notifications\AdminOrderPlacedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class CartController extends Controller
{
    private function makeCartKey(int $productId, ?int $variantId): string
    {
        return $productId . ':' . (int) ($variantId ?? 0);
    }

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
            'product_variant_id' => ['nullable', 'integer', 'exists:product_variants,id'],
            'quantity' => ['nullable', 'integer', 'min:1', 'max:10'],
            'redirect_to' => ['nullable', 'string'],
        ]);

        $product = Product::findOrFail($validated['product_id']);
        $variantId = isset($validated['product_variant_id']) ? (int) $validated['product_variant_id'] : null;
        $variant = null;
        if ($variantId) {
            $variant = ProductVariant::query()
                ->active()
                ->where('id', $variantId)
                ->where('product_id', $product->id)
                ->first();

            if (!$variant) {
                return redirect()->back()->with('error', 'Variante invalide.');
            }
        }
        $qty = (int) ($validated['quantity'] ?? 1);

        $cart = $this->getCart();
        $cartKey = $this->makeCartKey((int) $product->id, $variant?->id ? (int) $variant->id : null);
        $currentQty = (int) ($cart[$cartKey]['quantity'] ?? 0);
        $cart[$cartKey] = [
            'product_id' => $product->id,
            'product_variant_id' => $variant?->id,
            'quantity' => min(10, $currentQty + $qty),
        ];

        $this->putCart($cart);

        $shouldNotify = true;
        $throttleSeconds = 300;
        $lastNotifiedAt = (int) session()->get('admin_notif.cart_add.last_at', 0);
        if ($lastNotifiedAt > 0 && (time() - $lastNotifiedAt) < $throttleSeconds) {
            $shouldNotify = false;
        }

        if ($shouldNotify) {
            $admins = User::query()
                ->where('is_admin', true)
                ->where('is_active', true)
                ->get();

            if ($admins->isNotEmpty()) {
                Notification::send($admins, new AdminCartItemAddedNotification($product, $variant, $qty));
                session()->put('admin_notif.cart_add.last_at', time());
            }
        }

        $redirectTo = $validated['redirect_to'] ?? null;
        if ($redirectTo === 'shipping') {
            return redirect()->route('cart.shipping')->with('success', 'Produit ajouté au panier.');
        }

        return redirect()->route('cart.index')->with('success', 'Produit ajouté au panier.');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'cart_key' => ['nullable', 'string'],
            'product_id' => ['nullable', 'integer'],
            'quantity' => ['required', 'integer', 'min:1', 'max:10'],
        ]);

        $cart = $this->getCart();
        $cartKey = is_string($validated['cart_key'] ?? null) ? (string) $validated['cart_key'] : null;

        if ($cartKey && isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity'] = (int) $validated['quantity'];
        } else {
            $productId = (int) ($validated['product_id'] ?? 0);
            $legacyKey = $productId > 0 ? (string) $productId : null;
            if (!$legacyKey || !isset($cart[$legacyKey])) {
                return redirect()->route('cart.index');
            }
            $cart[$legacyKey]['quantity'] = (int) $validated['quantity'];
        }
        $this->putCart($cart);

        return redirect()->route('cart.index')->with('success', 'Quantité mise à jour.');
    }

    public function remove(Request $request)
    {
        $validated = $request->validate([
            'cart_key' => ['nullable', 'string'],
            'product_id' => ['nullable', 'integer'],
        ]);

        $cart = $this->getCart();
        $cartKey = is_string($validated['cart_key'] ?? null) ? (string) $validated['cart_key'] : null;
        if ($cartKey && isset($cart[$cartKey])) {
            unset($cart[$cartKey]);
        } else {
            $productId = (int) ($validated['product_id'] ?? 0);
            $legacyKey = $productId > 0 ? (string) $productId : null;
            if ($legacyKey && isset($cart[$legacyKey])) {
                unset($cart[$legacyKey]);
            }
        }
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
                    'product_variant_id' => $item->variant_id,
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

        $variantIds = $items
            ->pluck('product_variant_id')
            ->filter()
            ->map(fn ($id) => (int) $id)
            ->values()
            ->all();

        $variants = ProductVariant::query()
            ->whereIn('id', $variantIds)
            ->get()
            ->keyBy('id');

        $cartItems = $items->map(function ($item) use ($products, $variants) {
            $product = null;
            if ($item->product_id) {
                $product = $products->get((int) $item->product_id);
            }

            $variant = null;
            if ($item->product_variant_id) {
                $variant = $variants->get((int) $item->product_variant_id);
            }

            $options = null;
            if ($variant) {
                if (!empty($variant->variant_type)) {
                    $options = $variant->variant_type . ' • ' . $variant->places . ' place(s)';
                } else {
                    $options = $variant->thickness_cm . ' cm • ' . $variant->places . ' place(s)';
                }
            }

            return (object) [
                'id' => $item->product_id,
                'name' => $item->product_name,
                'slug' => $product?->slug,
                'image' => $product?->image ? asset($product->image) : null,
                'price' => $item->unit_price,
                'old_price' => null,
                'quantity' => $item->quantity,
                'options' => $options,
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
        $rows = collect($cart)
            ->filter(fn ($row) => is_array($row) && isset($row['product_id']))
            ->values();

        $productIds = $rows
            ->pluck('product_id')
            ->map(fn ($v) => (int) $v)
            ->unique()
            ->values()
            ->all();

        $variantIds = $rows
            ->map(fn ($row) => isset($row['product_variant_id']) ? (int) $row['product_variant_id'] : null)
            ->filter()
            ->values()
            ->all();

        $products = Product::query()
            ->whereIn('id', $productIds)
            ->get()
            ->keyBy('id');

        $variants = ProductVariant::query()
            ->whereIn('id', $variantIds)
            ->get()
            ->keyBy('id');

        $cartItems = collect($cart)
            ->filter(fn ($row) => is_array($row) && isset($row['product_id']))
            ->map(function ($row, $key) use ($products, $variants) {
                $productId = (int) ($row['product_id'] ?? 0);
                if (!$productId || !$products->has($productId)) {
                    return null;
                }
                $product = $products[$productId];
                $quantity = (int) ($row['quantity'] ?? 1);
                $variantId = isset($row['product_variant_id']) ? (int) $row['product_variant_id'] : null;
                $variant = $variantId ? $variants->get($variantId) : null;

                $price = (float) ($variant?->price ?? $product->price);
                $oldPrice = $variant?->old_price ? (float) $variant->old_price : ($product->old_price ? (float) $product->old_price : null);
                $options = null;
                if ($variant) {
                    if (!empty($variant->variant_type)) {
                        $options = $variant->variant_type . ' • ' . $variant->places . ' place(s)';
                    } else {
                        $options = $variant->thickness_cm . ' cm • ' . $variant->places . ' place(s)';
                    }
                }

                return (object) [
                    'cart_key' => (string) $key,
                    'id' => $product->id,
                    'variant_id' => $variant?->id,
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'image' => asset($product->image),
                    'price' => $price,
                    'shipping_price' => (float) ($product->shipping_price ?? 0),
                    'old_price' => $oldPrice,
                    'quantity' => $quantity,
                    'options' => $options,
                ];
            })
            ->filter()
            ->values();

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
