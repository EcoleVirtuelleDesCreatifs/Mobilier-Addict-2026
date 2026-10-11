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

        $mailWarning = null;

        try {
            if ((bool) $user->is_admin) {
                $status = Password::broker()->sendResetLink(['email' => $user->email]);

                if ($status !== Password::RESET_LINK_SENT) {
                    $mailWarning = __($status);
                    Log::warning('Admin reset link not sent', [
                        'user_id' => $user->id ?? null,
                        'email' => $user->email ?? null,
                        'status' => $status,
                    ]);
                }
            } else {
                if ($passwordProvided) {
                    $user->notify(new NewUserCredentialsNotification($plainPassword));
                }
            }
        } catch (\Throwable $e) {
            // If mail is not configured, we still want to create the user.
            $mailWarning = $e->getMessage();
            Log::error('Admin user creation mail failed', [
                'user_id' => $user->id ?? null,
                'email' => $user->email ?? null,
                'is_admin' => (bool) ($user->is_admin ?? false),
                'error' => $e->getMessage(),
            ]);
        }

        $redirect = redirect()->route('admin.users.show', $user)->with('success', 'Utilisateur créé avec succès.');
        if (!empty($mailWarning)) {
            $redirect->with('warning', "L'email d'activation n'a pas pu être envoyé automatiquement : {$mailWarning}");
        }

        return $redirect;
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
        $now = now();
        $summary = User::query()->selectRaw(
            'COUNT(*) as total,
            SUM(CASE WHEN is_active = 1 THEN 1 ELSE 0 END) as active,
            SUM(CASE WHEN is_active = 0 THEN 1 ELSE 0 END) as inactive,
            SUM(CASE WHEN created_at >= ? THEN 1 ELSE 0 END) as new_this_month,
            SUM(CASE WHEN last_login_at >= ? THEN 1 ELSE 0 END) as recently_active,
            SUM(CASE WHEN last_login_at IS NULL THEN 1 ELSE 0 END) as never_logged_in',
            [$now->copy()->startOfMonth(), $now->copy()->subDays(30)]
        )->first();

        $roleCounts = User::query()
            ->selectRaw("COALESCE(NULLIF(role, ''), 'sans_role') as role_name, COUNT(*) as total")
            ->groupBy('role_name')
            ->orderByDesc('total')
            ->get();

        $start = $now->copy()->subMonths(5)->startOfMonth();
        $registrations = User::query()
            ->where('created_at', '>=', $start)
            ->get(['created_at'])
            ->groupBy(fn (User $user) => $user->created_at->format('Y-m'));

        $monthlyGrowth = collect(range(0, 5))->map(function (int $offset) use ($start, $registrations) {
            $month = $start->copy()->addMonths($offset);

            return [
                'key' => $month->format('Y-m'),
                'label' => $month->translatedFormat('M'),
                'total' => $registrations->get($month->format('Y-m'), collect())->count(),
            ];
        });

        $recentUsers = User::query()
            ->orderByDesc('created_at')
            ->limit(10)
            ->get(['id', 'name', 'email', 'role', 'is_active', 'last_login_at', 'created_at', 'profile_picture']);

        return view('admin.users.stats', compact('summary', 'roleCounts', 'monthlyGrowth', 'recentUsers'));
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
