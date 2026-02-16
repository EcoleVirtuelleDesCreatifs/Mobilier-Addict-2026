<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Notifications\NewUserCredentialsNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()->orderByDesc('created_at')->paginate(15)->withQueryString();

        return view('admin.users.index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        return view('admin.users.create', [
            'roles' => $this->roleNames(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
            'fonction' => ['nullable', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:50'],
            'profile_picture' => ['nullable', 'image', 'max:2048'],
        ]);

        $passwordProvided = !empty($data['password']);
        $plainPassword = $data['password'] ?? null;

        if ($request->hasFile('profile_picture')) {
            $data['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        $data['is_admin'] = in_array($data['role'], ['admin', 'super_admin']);
        $data['is_active'] = true;

        if (empty($plainPassword)) {
            $plainPassword = Str::random(24);
        }

        $data['password'] = Hash::make($plainPassword);

        $user = User::create($data);

        try {
            if ((bool) $user->is_admin) {
                Password::broker()->sendResetLink(['email' => $user->email]);
            } else {
                if ($passwordProvided) {
                    $user->notify(new NewUserCredentialsNotification($plainPassword));
                }
            }
        } catch (\Throwable $e) {
            // If mail is not configured, we still want to create the user.
            Log::error('Admin user creation mail failed', [
                'user_id' => $user->id ?? null,
                'email' => $user->email ?? null,
                'is_admin' => (bool) ($user->is_admin ?? false),
                'error' => $e->getMessage(),
            ]);
        }

        return redirect()->route('admin.users.show', $user)->with('success', 'Utilisateur créé avec succès.');
    }

    public function show(User $user)
    {
        $user->load(['articles']);

        return view('admin.users.show', [
            'user' => $user,
        ]);
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'user' => $user,
            'roles' => $this->roleNames(),
        ]);
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
            'fonction' => ['nullable', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:50'],
            'profile_picture' => ['nullable', 'image', 'max:2048'],
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        if ($request->hasFile('profile_picture')) {
            $data['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        $data['is_admin'] = in_array($data['role'], ['admin', 'super_admin']);

        $user->update($data);

        return redirect()->route('admin.users.show', $user)->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }

    public function stats()
    {
        $totalUsers = User::query()->count();
        $adminCount = User::query()->where('role', 'admin')->count();
        $editorCount = User::query()->where('role', 'editor')->count();
        $writerCount = User::query()->where('role', 'writer')->count();
        $recentUsers = User::query()->orderByDesc('created_at')->limit(8)->get();

        return view('admin.users.stats', compact('totalUsers', 'adminCount', 'editorCount', 'writerCount', 'recentUsers'));
    }

    public function changeRole(Request $request, User $user): JsonResponse
    {
        $data = $request->validate([
            'role' => ['required', 'string', 'max:50'],
        ]);

        $user->role = $data['role'];
        $user->is_admin = in_array($data['role'], ['admin', 'super_admin']);
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Rôle mis à jour.',
        ]);
    }

    public function toggleStatus(User $user): JsonResponse
    {
        if ($user->id === auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Vous ne pouvez pas désactiver votre propre compte.',
            ], 422);
        }

        $user->is_active = !$user->is_active;
        $user->save();

        return response()->json([
            'success' => true,
            'is_active' => (bool) $user->is_active,
            'message' => $user->is_active ? 'Utilisateur activé.' : 'Utilisateur désactivé.',
        ]);
    }

    private function roleNames(): array
    {
        Role::query()->firstOrCreate(['name' => 'admin'], ['display_name' => 'Admin', 'order' => 1, 'is_active' => true]);
        Role::query()->firstOrCreate(['name' => 'editor'], ['display_name' => 'Éditeur', 'order' => 2, 'is_active' => true]);
        Role::query()->firstOrCreate(['name' => 'writer'], ['display_name' => 'Rédacteur', 'order' => 3, 'is_active' => true]);

        return Role::query()->ordered()->pluck('name')->all();
    }
}
