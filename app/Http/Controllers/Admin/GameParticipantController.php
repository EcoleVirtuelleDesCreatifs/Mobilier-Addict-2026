<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GameController;
use App\Models\GameParticipant;
use App\Models\SiteSetting;
use App\Support\GameBadge;
use App\Support\ImageOptimizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function edit(GameParticipant $participant)
    {
        return view('admin.game.edit', [
            'participant' => $participant,
            'prizes' => GameController::PRIZES,
        ]);
    }

    public function update(Request $request, GameParticipant $participant)
    {
        $data = $request->validate([
            'lastname' => ['required', 'string', 'max:100'],
            'firstnames' => ['required', 'string', 'max:150'],
            'whatsapp' => ['required', 'string', 'max:32'],
            'city' => ['required', 'string', 'max:120'],
            'public_name' => ['required', 'string', 'max:60'],
            'prize' => ['required', 'string', 'in:' . implode(',', GameController::PRIZES)],
            'supports_count' => ['required', 'integer', 'min:0'],
            'photo' => ['nullable', 'image', 'max:4096'],
            'remove_photo' => ['nullable', 'boolean'],
        ], [
            'required' => 'Ce champ est obligatoire.',
            'photo.image' => 'La photo doit être une image valide.',
            'photo.max' => 'La photo ne doit pas dépasser 4 Mo.',
        ]);

        $oldPhoto = $participant->photo;
        $oldBadge = $participant->badge_path;
        $photoChanged = false;

        if ($request->boolean('remove_photo')) {
            $data['photo'] = null;
            $photoChanged = true;
        } elseif ($request->hasFile('photo')) {
            $data['photo'] = ImageOptimizer::storePublicUpload($request->file('photo'), 'uploads/game/photos', 1200, 82);
            $photoChanged = true;
        } else {
            unset($data['photo']);
        }

        unset($data['remove_photo']);
        $participant->update($data);

        $newBadge = GameBadge::generate($participant->fresh());
        if ($newBadge) {
            $participant->update(['badge_path' => $newBadge]);
            $this->deletePublicFile($oldBadge);
        }

        if ($photoChanged && $oldPhoto !== $participant->photo) {
            $this->deletePublicFile($oldPhoto);
        }

        return redirect()->route('admin.game.index')->with('status', 'Participant et badge mis à jour.');
    }

    public function destroy(GameParticipant $participant)
    {
        $this->deletePublicFile($participant->photo);
        $this->deletePublicFile($participant->badge_path);
        $participant->delete();

        return redirect()->route('admin.game.index')->with('status', 'Participant supprimé.');
    }

    private function deletePublicFile(?string $path): void
    {
        $path = trim((string) $path);
        if (str_starts_with($path, 'storage/')) {
            Storage::disk('public')->delete(substr($path, 8));
        } elseif (str_starts_with($path, 'uploads/')) {
            $file = public_path($path);
            if (is_file($file)) {
                @unlink($file);
            }
        }
    }
}
