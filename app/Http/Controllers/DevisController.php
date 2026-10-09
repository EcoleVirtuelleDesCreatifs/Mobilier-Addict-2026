<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\User;
use App\Notifications\AdminQuoteRequestNotification;
use App\Notifications\QuoteConfirmationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\RateLimiter;

class DevisController extends Controller
{
    public const ORGANIZATION_TYPES = [
        'entreprise' => 'Entreprise',
        'institution' => 'Institution publique',
        'hotellerie' => 'Hôtel / Hôtellerie',
        'restaurant' => 'Restaurant / Café',
        'ong' => 'ONG / Association',
        'bureau' => 'Bureau / Coworking',
        'autre' => 'Autre structure',
    ];

    public const BUDGET_RANGES = [
        'lt500k' => 'Moins de 500 000 FCFA',
        '500k-1m' => '500 000 – 1 000 000 FCFA',
        '1m-5m' => '1 000 000 – 5 000 000 FCFA',
        'gt5m' => 'Plus de 5 000 000 FCFA',
        'unknown' => 'À définir ensemble',
    ];

    public function create()
    {
        return view('pages.devis', [
            'organizationTypes' => self::ORGANIZATION_TYPES,
            'budgetRanges' => self::BUDGET_RANGES,
        ]);
    }

    public function store(Request $request)
    {
        // Honeypot anti-spam (champ invisible pour les humains)
        if ($request->filled('website')) {
            return redirect()->route('devis.create');
        }

        $throttleKey = 'devis|' . $request->ip();
        if (RateLimiter::tooManyAttempts($throttleKey, 3)) {
            return redirect()
                ->route('devis.create')
                ->with('error', 'Trop de demandes envoyées. Réessayez dans quelques minutes.');
        }

        $validated = $request->validate([
            'organization_type' => ['required', 'string', 'in:' . implode(',', array_keys(self::ORGANIZATION_TYPES))],
            'company_name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'firstnames' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'whatsapp' => ['required', 'string', 'max:50'],
            'phone' => ['nullable', 'string', 'max:50'],
            'delivery_place' => ['nullable', 'string', 'max:255'],
            'delivery_day' => ['nullable', 'date'],
            'budget_range' => ['nullable', 'string', 'in:' . implode(',', array_keys(self::BUDGET_RANGES))],
            'details' => ['required', 'string', 'max:5000'],
        ], [
            'organization_type.required' => 'Sélectionnez le type de structure.',
            'company_name.required' => 'Indiquez le nom de votre structure.',
            'lastname.required' => 'Indiquez le nom du contact.',
            'whatsapp.required' => 'Un numéro WhatsApp est nécessaire pour vous recontacter.',
            'details.required' => 'Décrivez votre besoin (articles, quantités, dimensions…).',
        ]);

        $quote = Quote::create([
            'number' => $this->nextNumber(),
            'status' => 'pending',
            'issued_at' => now()->toDateString(),
            'lastname' => $validated['lastname'],
            'firstnames' => $validated['firstnames'] ?? null,
            'company_name' => $validated['company_name'],
            'email' => $validated['email'] ?? null,
            'organization_type' => $validated['organization_type'],
            'whatsapp' => $validated['whatsapp'],
            'phone' => $validated['phone'] ?? null,
            'delivery_place' => $validated['delivery_place'] ?? null,
            'delivery_day' => $validated['delivery_day'] ?? null,
            'budget_range' => $validated['budget_range'] ?? null,
            'details' => $validated['details'],
        ]);

        RateLimiter::hit($throttleKey, 600);

        try {
            if (! empty($quote->email)) {
                Notification::route('mail', $quote->email)
                    ->notify(new QuoteConfirmationNotification($quote));
            }

            $admins = User::query()
                ->where('is_active', true)
                ->whereNotNull('email')
                ->where(function ($q) {
                    $q->where('is_admin', true)->orWhereIn('role', ['admin', 'super_admin']);
                })
                ->get();

            if ($admins->isNotEmpty()) {
                Notification::send($admins, new AdminQuoteRequestNotification($quote));
            }
        } catch (\Throwable $e) {
            Log::error('Quote notifications failed to send', [
                'quote_id' => $quote->id,
                'error' => $e->getMessage(),
            ]);
        }

        return redirect()
            ->route('devis.create')
            ->with('success', 'Votre demande de devis ' . $quote->number . ' a bien été envoyée. Notre équipe vous contactera rapidement.');
    }

    private function nextNumber(): string
    {
        $prefix = 'DVS-' . now()->format('Ym') . '-';
        $last = Quote::query()
            ->where('number', 'like', $prefix . '%')
            ->orderByDesc('number')
            ->value('number');

        $seq = $last ? ((int) substr($last, -4)) + 1 : 1;

        return $prefix . str_pad((string) $seq, 4, '0', STR_PAD_LEFT);
    }
}
