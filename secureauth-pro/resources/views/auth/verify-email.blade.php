<x-guest-layout>
    <div class="mb-6 text-center">
        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-amber-100 text-amber-700 dark:bg-amber-950 dark:text-amber-300">
            <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16v12H4V6Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="m4 7 8 6 8-6" />
            </svg>
        </div>
        <h1 class="mt-4 text-3xl font-extrabold text-slate-950 dark:text-white">Verify your email</h1>
        <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">Your dashboard stays locked until this email address is verified.</p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <x-auth-session-status class="mb-5" :status="__('A new verification link has been sent to your email address.')" />
    @endif

    <div class="space-y-3">
        <form method="POST" action="{{ route('verification.send') }}" x-data="{ submitting: false }" x-on:submit="submitting = true">
            @csrf

            <x-primary-button class="w-full justify-center" x-bind:disabled="submitting">
                <span x-show="! submitting">{{ __('Resend verification email') }}</span>
                <span x-show="submitting" x-cloak>{{ __('Sending...') }}</span>
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="w-full rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800">
                {{ __('Log out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
