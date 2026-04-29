@php
    $message = session('success')
        ?? (session('status') === 'verification-link-sent'
            ? __('A new verification link has been sent to your email address.')
            : session('status'));
@endphp

@if ($message || $errors->any())
    <div
        x-data="{ show: true }"
        x-show="show"
        x-transition
        class="mx-auto max-w-7xl px-4 pt-6 sm:px-6 lg:px-8"
    >
        <div class="flex items-start justify-between gap-4 rounded-2xl border {{ $errors->any() ? 'border-rose-200 bg-rose-50 text-rose-800 dark:border-rose-900/70 dark:bg-rose-950/30 dark:text-rose-200' : 'border-emerald-200 bg-emerald-50 text-emerald-800 dark:border-emerald-900/70 dark:bg-emerald-950/30 dark:text-emerald-200' }} px-4 py-3 shadow-sm">
            <p class="text-sm font-semibold">{{ $errors->any() ? __('Please fix the highlighted fields.') : $message }}</p>
            <button type="button" x-on:click="show = false" class="rounded-full p-1 text-current/70 transition hover:bg-black/5 hover:text-current dark:hover:bg-white/10">
                <span class="sr-only">{{ __('Dismiss') }}</span>
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m6 6 12 12M18 6 6 18" />
                </svg>
            </button>
        </div>
    </div>
@endif
