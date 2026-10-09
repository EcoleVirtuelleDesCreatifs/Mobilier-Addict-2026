<?php

namespace App\Http\Controllers;

use App\Models\GameParticipant;
use App\Models\Product;
use App\Models\SiteSetting;
use App\Support\GameBadge;
use App\Support\ImageOptimizer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GameController extends Controller
{
    public const PRIZES = [
        'Un matelas confort Mobilier Addict',
        'Un oreiller premium',
        'Un pack draps & couette',
        'Une remise de 50 000 F CFA',
    ];

    public static function endsAt(): ?Carbon
    {
        $raw = trim((string) SiteSetting::getValue('game_ends_at', ''));
        if ($raw === '') {
            return null;
        }

        try {
            return Carbon::parse($raw);
        } catch (\Throwable) {
            return null;
        }
    }

    public static function isClosed(): bool
    {
        $ends = self::endsAt();

        return $ends !== null && now()->greaterThan($ends);
    }

    private function guardClosed()
    {
        if (self::isClosed()) {
            return redirect()->route('home')->with('status', 'Le Grand Jeu est terminé. Merci à tous les participants !');
        }

        return null;
    }

    public function index()
    {
        if ($r = $this->guardClosed()) {
            return $r;
        }

        $endsAt = self::endsAt();
        $participants = GameParticipant::query()
            ->orderByDesc('supports_count')
            ->orderByDesc('created_at')
            ->get(['id', 'public_name', 'slug', 'supports_count', 'badge_path', 'prize']);

        return view('maquette.game.index', [
            'prizes' => self::PRIZES,
            'participantsCount' => $participants->count(),
            'topParticipants' => $participants->take(3),
            'participants' => $participants,
            'endsAt' => $endsAt,
        ]);
    }

    public function store(Request $request)
    {
        if ($r = $this->guardClosed()) {
            return $r;
        }

        $data = $request->validate([
            'lastname' => ['required', 'string', 'max:100'],
            'firstnames' => ['required', 'string', 'max:150'],
            'whatsapp' => ['required', 'string', 'max:32'],
            'city' => ['required', 'string', 'max:120'],
            'public_name' => ['required', 'string', 'max:60'],
            'photo' => ['nullable', 'image', 'max:4096'],
            'prize' => ['required', 'string', 'in:' . implode(',', self::PRIZES)],
        ], [
            'required' => 'Ce champ est obligatoire.',
            'photo.image' => 'La photo doit être une image.',
            'photo.max' => 'La photo ne doit pas dépasser 4 Mo.',
            'prize.in' => 'Cadeau invalide.',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = ImageOptimizer::storePublicUpload($request->file('photo'), 'uploads/game/photos', 1200, 82);
        }

        $participant = GameParticipant::createWithUniqueSlug([
            'lastname' => $data['lastname'],
            'firstnames' => $data['firstnames'],
            'whatsapp' => $data['whatsapp'],
            'city' => $data['city'],
            'public_name' => $data['public_name'],
            'prize' => $data['prize'],
            'photo' => $photoPath,
        ]);

        $badgePath = GameBadge::generate($participant);
        if ($badgePath) {
            $participant->update(['badge_path' => $badgePath]);
        }

        return redirect()
            ->route('game.show', $participant->slug)
            ->with('status', 'Ton badge est prêt ! Télécharge-le et partage-le avec #MobilierAddict #MatelasAddict');
    }

    public function show(GameParticipant $participant)
    {
        if ($r = $this->guardClosed()) {
            return $r;
        }

        $products = Product::query()
            ->active()
            ->ordered()
            ->take(4)
            ->get(['id', 'name', 'slug', 'image', 'price', 'old_price']);

        $rank = GameParticipant::query()
            ->where('supports_count', '>', $participant->supports_count)
            ->count() + 1;

        $alreadySupported = request()->session()->has('game.supported.' . $participant->id);

        return view('maquette.game.show', compact('participant', 'products', 'rank', 'alreadySupported'));
    }

    public function support(Request $request, GameParticipant $participant)
    {
        if ($r = $this->guardClosed()) {
            return $r;
        }

        $key = 'game.supported.' . $participant->id;

        if (!$request->session()->has($key)) {
            $participant->increment('supports_count');
            $request->session()->put($key, true);
        }

        return redirect()
            ->route('game.show', $participant->slug)
            ->with('status', 'Merci pour ton soutien à ' . $participant->public_name . ' !');
    }

    public function badge(GameParticipant $participant)
    {
        $path = trim((string) $participant->badge_path);
        $local = Str::startsWith($path, 'storage/')
            ? storage_path('app/public/' . preg_replace('#^storage/#', '', $path))
            : public_path(ltrim($path, '/'));

        abort_unless($path !== '' && is_file($local), 404);

        return response()->download($local, 'badge-mobilier-addict-' . $participant->slug . '.png', [
            'Content-Type' => 'image/png',
        ]);
    }
}
