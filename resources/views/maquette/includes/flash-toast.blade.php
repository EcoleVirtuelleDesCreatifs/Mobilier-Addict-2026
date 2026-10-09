@if(session('success') || session('error') || session('warning') || $errors->any())
    @php
        $toasts = [];
        if (session('success')) $toasts[] = ['type' => 'success', 'msg' => session('success')];
        if (session('error'))   $toasts[] = ['type' => 'error',   'msg' => session('error')];
        if (session('warning')) $toasts[] = ['type' => 'warning', 'msg' => session('warning')];
        foreach ($errors->all() as $e) $toasts[] = ['type' => 'error', 'msg' => $e];
    @endphp
    <div class="mp-toast-stack" aria-live="polite" aria-atomic="false">
        @foreach($toasts as $t)
            <div class="mp-toast mp-toast-{{ $t['type'] }}" role="{{ $t['type'] === 'error' ? 'alert' : 'status' }}">
                <span class="mp-toast-icon" aria-hidden="true">
                    @if($t['type'] === 'success')
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                    @elseif($t['type'] === 'warning')
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 8v5"/><path d="M12 16.5h.01"/><path d="M10.3 3.6 1.9 18a2 2 0 0 0 1.7 3h16.8a2 2 0 0 0 1.7-3L13.7 3.6a2 2 0 0 0-3.4 0z"/></svg>
                    @else
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="m15 9-6 6"/><path d="m9 9 6 6"/></svg>
                    @endif
                </span>
                <span class="mp-toast-msg">{{ $t['msg'] }}</span>
                <button type="button" class="mp-toast-close" aria-label="Fermer la notification">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
                </button>
                <span class="mp-toast-bar"></span>
            </div>
        @endforeach
    </div>
    <script>
        document.querySelectorAll('.mp-toast').forEach(function (toast) {
            var dismiss = function () {
                toast.classList.add('is-leaving');
                setTimeout(function () { toast.remove(); }, 320);
            };
            var timer = setTimeout(dismiss, 5000);
            toast.querySelector('.mp-toast-close').addEventListener('click', function () {
                clearTimeout(timer);
                dismiss();
            });
        });
    </script>
@endif
