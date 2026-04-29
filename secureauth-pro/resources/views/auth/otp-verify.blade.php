<x-guest-layout>
    <div class="mb-6 text-center">
        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-cyan-100 text-cyan-700 dark:bg-cyan-950 dark:text-cyan-300">
            <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 17v.01M8 10V8a4 4 0 1 1 8 0v2m-9 0h10v10H7V10Z" />
            </svg>
        </div>
        <h1 class="mt-4 text-3xl font-extrabold text-slate-950 dark:text-white">Enter OTP</h1>
        <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">A six-digit code was sent to {{ auth()->user()->email }}.</p>
    </div>

    <x-auth-session-status class="mb-5" :status="session('status')" />

    <form method="POST" action="{{ route('otp.verify') }}" class="space-y-5" x-data="{ submitting: false }" x-on:submit="submitting = true">
        @csrf

        <div>
            <x-input-label for="otp" :value="__('One-time code')" class="text-center" />
            <input
                id="otp"
                name="otp"
                inputmode="numeric"
                autocomplete="one-time-code"
                maxlength="6"
                pattern="[0-9]{6}"
                class="mt-3 block w-full rounded-2xl border-slate-200 bg-white/90 px-4 py-4 text-center text-3xl font-extrabold text-slate-950 shadow-sm transition focus:border-cyan-500 focus:ring-cyan-500 dark:border-slate-700 dark:bg-slate-950/80 dark:text-white dark:focus:border-cyan-400 dark:focus:ring-cyan-400"
                required
                autofocus
            />
            <x-input-error :messages="$errors->get('otp')" class="mt-2 text-center" />
        </div>

        <x-primary-button class="w-full justify-center" x-bind:disabled="submitting">
            <span x-show="! submitting">{{ __('Verify OTP') }}</span>
            <span x-show="submitting" x-cloak>{{ __('Verifying...') }}</span>
        </x-primary-button>
    </form>

    <form method="POST" action="{{ route('otp.resend') }}" class="mt-3" x-data="{ sending: false }" x-on:submit="sending = true">
        @csrf
        <button type="submit" x-bind:disabled="sending" class="w-full rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 disabled:cursor-not-allowed disabled:opacity-60 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800">
            <span x-show="! sending">{{ __('Resend OTP') }}</span>
            <span x-show="sending" x-cloak>{{ __('Sending...') }}</span>
        </button>
    </form>

    <form method="POST" action="{{ route('logout') }}" class="mt-3">
        @csrf
        <button type="submit" class="w-full text-sm font-semibold text-slate-500 transition hover:text-slate-950 dark:text-slate-400 dark:hover:text-white">{{ __('Log out') }}</button>
    </form>
</x-guest-layout>
