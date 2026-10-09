<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GameParticipant;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class GameParticipantController extends Controller
{
    public function index(Request $request)
    {
        $query = GameParticipant::query();

        if ($search = $request->string('q')->trim()->toString()) {
            $query->where(function ($q) use ($search) {
                $q->where('public_name', 'like', "%{$search}%")
                    ->orWhere('lastname', 'like', "%{$search}%")
                    ->orWhere('firstnames', 'like', "%{$search}%")
                    ->orWhere('whatsapp', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%");
            });
        }

        $sort = $request->string('sort')->toString() === 'supports' ? 'supports_count' : 'created_at';
        $dir = $request->string('dir')->toString() === 'asc' ? 'asc' : 'desc';

        $participants = $query->orderBy($sort, $dir)->paginate(15)->withQueryString();

        $stats = [
            'total' => GameParticipant::count(),
            'supports' => (int) GameParticipant::sum('supports_count'),
            'today' => GameParticipant::where('created_at', '>=', now()->startOfDay())->count(),
        ];

        return view('admin.game.index', compact('participants', 'stats'), [
            'gameEndsAt' => SiteSetting::getValue('game_ends_at', ''),
            'gameClosed' => \App\Http\Controllers\GameController::isClosed(),
        ]);
    }

    public function updateSettings(Request $request)
    {
        $data = $request->validate([
            'game_ends_at' => ['nullable', 'date'],
        ]);

        SiteSetting::setValue('game_ends_at', $data['game_ends_at'] ?? '');

        return redirect()->route('admin.game.index')->with('status', !empty($data['game_ends_at'])
            ? 'Fin du jeu programmée : ' . $data['game_ends_at']
            : 'Aucune date de fin — le jeu reste ouvert.');
    }

    public function destroy(GameParticipant $participant)
    {
        $participant->delete();

        return redirect()->route('admin.game.index')->with('status', 'Participant supprimé.');
    }
}
