<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscription;
use Illuminate\Http\Request;

class NewsletterSubscriptionController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->string('q')->trim()->toString();

        $subscriptionsQuery = NewsletterSubscription::query()->orderByDesc('subscribed_at')->orderByDesc('created_at');

        if ($q !== '') {
            $subscriptionsQuery->where('email', 'like', '%' . $q . '%');
        }

        $subscriptions = $subscriptionsQuery->paginate(25)->withQueryString();

        $counts = [
            'total' => NewsletterSubscription::count(),
            'active' => NewsletterSubscription::query()->where('is_active', true)->count(),
            'inactive' => NewsletterSubscription::query()->where('is_active', false)->count(),
        ];

        return view('admin.newsletter.index', [
            'subscriptions' => $subscriptions,
            'counts' => $counts,
        ]);
    }
}
