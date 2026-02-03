<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::query()->withCount('users')->ordered()->paginate(15)->withQueryString();

        return view('admin.roles.index', [
            'roles' => $roles,
        ]);
    }

    public function create()
    {
        $nextOrder = (int) (Role::query()->max('order') ?? 0) + 1;

        return view('admin.roles.create', [
            'nextOrder' => $nextOrder,
            'availablePermissions' => $this->availablePermissions(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z0-9_-]+$/', 'unique:roles,name'],
            'display_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'order' => ['required', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['string'],
        ]);

        $data['is_active'] = (bool) ($data['is_active'] ?? false);
        $data['permissions'] = array_values(array_unique(array_filter($data['permissions'] ?? [], fn ($v) => is_string($v) && $v !== '')));

        $role = Role::create($data);

        return redirect()->route('admin.roles.show', $role)->with('success', 'Rôle créé avec succès.');
    }

    public function show(Role $role)
    {
        $role->loadCount('users');
        $role->load(['users' => function ($q) {
            $q->orderByDesc('created_at');
        }]);

        $recentUsers = $role->users()->orderByDesc('created_at')->limit(10)->get();

        return view('admin.roles.show', [
            'role' => $role,
            'recentUsers' => $recentUsers,
            'availablePermissions' => $this->availablePermissions(),
        ]);
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit', [
            'role' => $role,
            'availablePermissions' => $this->availablePermissions(),
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $lockedNames = ['admin', 'editor', 'writer'];

        $rules = [
            'display_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'order' => ['required', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['string'],
        ];

        if (!in_array($role->name, $lockedNames, true)) {
            $rules['name'] = ['required', 'string', 'max:255', 'regex:/^[a-zA-Z0-9_-]+$/', 'unique:roles,name,' . $role->id];
        }

        $data = $request->validate($rules);

        if (in_array($role->name, $lockedNames, true)) {
            unset($data['name']);
        }

        if ($role->name === 'admin') {
            unset($data['is_active']);
        }

        $data['is_active'] = (bool) ($data['is_active'] ?? false);
        $data['permissions'] = array_values(array_unique(array_filter($data['permissions'] ?? [], fn ($v) => is_string($v) && $v !== '')));

        $role->update($data);

        return redirect()->route('admin.roles.show', $role)->with('success', 'Rôle mis à jour avec succès.');
    }

    public function destroy(Role $role)
    {
        if (in_array($role->name, ['admin', 'editor', 'writer'], true)) {
            return redirect()->route('admin.roles.index')->with('error', 'Suppression non autorisée.');
        }

        if ($role->users()->exists()) {
            return redirect()->route('admin.roles.index')->with('error', 'Suppression impossible : des utilisateurs utilisent ce rôle.');
        }

        $role->delete();

        return redirect()->route('admin.roles.index')->with('success', 'Rôle supprimé.');
    }

    public function toggle(Role $role): JsonResponse
    {
        if ($role->name === 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Impossible de désactiver ce rôle.',
            ], 422);
        }

        $role->is_active = !$role->is_active;
        $role->save();

        return response()->json([
            'success' => true,
            'is_active' => (bool) $role->is_active,
            'message' => $role->is_active ? 'Rôle activé.' : 'Rôle désactivé.',
        ]);
    }

    private function availablePermissions(): array
    {
        return [
            'articles' => [
                'articles.manage' => 'Gérer les articles',
            ],
            'orders' => [
                'orders.view' => 'Voir les commandes',
                'orders.update_status' => 'Mettre à jour le statut des commandes',
            ],
            'products' => [
                'products.manage' => 'Gérer les produits',
            ],
            'categories' => [
                'categories.manage' => 'Gérer les catégories',
            ],
            'menus' => [
                'menus.manage' => 'Gérer les menus',
            ],
            'users' => [
                'users.manage' => 'Gérer les utilisateurs',
            ],
            'roles' => [
                'roles.manage' => 'Gérer les rôles',
            ],
            'stats' => [
                'stats.view' => 'Voir les statistiques',
            ],
            'newsletter' => [
                'newsletter.view' => 'Voir la newsletter',
            ],
        ];
    }
}
