<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if (!$user || !Schema::hasTable('notifications')) {
            return view('admin.notifications.index', [
                'notifications' => collect(),
                'notificationsMissing' => true,
            ]);
        }

        $read = $request->string('read')->trim()->toString();
        if (!in_array($read, ['', 'unread', 'read'], true)) {
            $read = '';
        }

        $handled = $request->string('handled')->trim()->toString();
        if (!in_array($handled, ['', 'unhandled', 'handled'], true)) {
            $handled = '';
        }

        $query = $user->notifications()->latest();

        if ($read === 'unread') {
            $query->whereNull('read_at');
        } elseif ($read === 'read') {
            $query->whereNotNull('read_at');
        }

        if ($handled === 'handled') {
            $query->whereNotNull('data->handled_at');
        } elseif ($handled === 'unhandled') {
            $query->whereNull('data->handled_at');
        }

        $notifications = $query->paginate(25)->withQueryString();

        return view('admin.notifications.index', [
            'notifications' => $notifications,
            'notificationsMissing' => false,
        ]);
    }

    public function markAsRead(Request $request, string $notification)
    {
        $user = $request->user();

        $notif = $user->notifications()->where('id', $notification)->firstOrFail();
        $notif->markAsRead();

        $redirectTo = $request->input('redirect_to');
        if (is_string($redirectTo) && $redirectTo !== '') {
            return redirect($redirectTo);
        }

        return back();
    }

    public function markAllAsRead(Request $request)
    {
        $request->user()->unreadNotifications->markAsRead();

        return back();
    }

    public function markAsHandled(Request $request, string $notification)
    {
        $user = $request->user();

        $notif = $user->notifications()->where('id', $notification)->firstOrFail();
        $data = is_array($notif->data) ? $notif->data : [];
        $data['handled_at'] = Carbon::now()->toISOString();
        $notif->data = $data;
        $notif->save();

        $redirectTo = $request->input('redirect_to');
        if (is_string($redirectTo) && $redirectTo !== '') {
            return redirect($redirectTo);
        }

        return back();
    }

    public function markAsUnhandled(Request $request, string $notification)
    {
        $user = $request->user();

        $notif = $user->notifications()->where('id', $notification)->firstOrFail();
        $data = is_array($notif->data) ? $notif->data : [];
        unset($data['handled_at']);
        $notif->data = $data;
        $notif->save();

        $redirectTo = $request->input('redirect_to');
        if (is_string($redirectTo) && $redirectTo !== '') {
            return redirect($redirectTo);
        }

        return back();
    }
}
