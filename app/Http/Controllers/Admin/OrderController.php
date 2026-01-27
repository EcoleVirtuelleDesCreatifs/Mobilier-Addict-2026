<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        if (!Schema::hasTable('orders')) {
            return view('admin.orders.index', [
                'orders' => collect(),
                'ordersMissing' => true,
            ]);
        }

        $allowedStatuses = ['pending', 'confirmed', 'shipping', 'delivered', 'canceled'];
        $status = $request->string('status')->trim()->toString();
        if ($status !== '' && !in_array($status, $allowedStatuses, true)) {
            $status = '';
        }

        $search = $request->string('q')->trim()->toString();

        $ordersTotalCount = Order::query()->count();
        $ordersDeliveredCount = Order::query()->where('status', 'delivered')->count();
        $ordersShippingCount = Order::query()->where('status', 'shipping')->count();
        $ordersTodayCount = Order::query()->whereDate('created_at', Carbon::today())->count();

        $orders = Order::query()
            ->with(['user'])
            ->withCount('items')
            ->when($status !== '', fn ($q) => $q->where('status', $status))
            ->when($search !== '', function ($q) use ($search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('lastname', 'like', "%{$search}%")
                        ->orWhere('firstnames', 'like', "%{$search}%")
                        ->orWhere('whatsapp', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('id', $search);
                });
            })
            ->orderByDesc('created_at')
            ->paginate(20)
            ->withQueryString();

        return view('admin.orders.index', [
            'orders' => $orders,
            'ordersMissing' => false,
            'allowedStatuses' => $allowedStatuses,
            'ordersTotalCount' => $ordersTotalCount,
            'ordersDeliveredCount' => $ordersDeliveredCount,
            'ordersShippingCount' => $ordersShippingCount,
            'ordersTodayCount' => $ordersTodayCount,
        ]);
    }

    public function show(Order $order)
    {
        if (!Schema::hasTable('orders')) {
            abort(404);
        }

        $order->load(['items', 'user']);

        return view('admin.orders.show', [
            'order' => $order,
            'allowedStatuses' => ['pending', 'confirmed', 'shipping', 'delivered', 'canceled'],
        ]);
    }

    public function updateStatus(Request $request, Order $order)
    {
        if (!Schema::hasTable('orders')) {
            abort(404);
        }

        $data = $request->validate([
            'status' => ['required', 'string', 'in:pending,confirmed,shipping,delivered,canceled'],
        ]);

        $order->update(['status' => $data['status']]);

        return back()->with('status', 'Statut de la commande mis à jour.');
    }
}
