<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscription;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email:rfc,dns', 'max:255'],
        ]);

        $email = mb_strtolower(trim($validated['email']));

        $subscription = NewsletterSubscription::query()->where('email', $email)->first();

        if ($subscription) {
            if ($subscription->is_active) {
                return back()->with('success', 'Vous êtes déjà inscrit(e) à la newsletter.');
            }

            $subscription->fill([
                'is_active' => true,
                'subscribed_at' => now(),
                'unsubscribed_at' => null,
            ])->save();

            return back()->with('success', 'Votre inscription à la newsletter a été réactivée.');
        }

        NewsletterSubscription::query()->create([
            'email' => $email,
            'is_active' => true,
            'subscribed_at' => now(),
        ]);

        return back()->with('success', 'Merci ! Votre inscription à la newsletter est confirmée.');
    }
}
