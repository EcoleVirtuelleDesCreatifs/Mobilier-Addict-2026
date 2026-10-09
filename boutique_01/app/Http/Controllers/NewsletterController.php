<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscription;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $validated = $request->validateWithBag('newsletter', [
            'email' => ['required', 'email:rfc', 'max:255'],
        ], [
            'email.required' => 'Indiquez votre adresse e-mail.',
            'email.email' => 'Cette adresse e-mail ne semble pas valide.',
        ]);

        $email = mb_strtolower(trim($validated['email']));

        $subscription = NewsletterSubscription::query()->where('email', $email)->first();

        if ($subscription) {
            if ($subscription->is_active) {
                return back()
                    ->with('newsletter_success', 'Vous êtes déjà inscrit(e) à la newsletter.')
                    ->withInput();
            }

            $subscription->fill([
                'is_active' => true,
                'subscribed_at' => now(),
                'unsubscribed_at' => null,
            ])->save();

            return back()->with('newsletter_success', 'Votre inscription à la newsletter a été réactivée.');
        }

        NewsletterSubscription::query()->create([
            'email' => $email,
            'is_active' => true,
            'subscribed_at' => now(),
        ]);

        return back()->with('newsletter_success', 'Merci ! Votre inscription à la newsletter est confirmée.');
    }
}
