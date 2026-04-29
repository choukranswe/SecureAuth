<x-guest-layout>
    <div class="mb-6">
        <p class="text-sm font-semibold uppercase text-cyan-700 dark:text-cyan-300">Secure sign in</p>
        <h1 class="mt-2 text-3xl font-extrabold text-slate-950 dark:text-white">Welcome back</h1>
        <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">Password first, email OTP next.</p>
    </div>

    <x-auth-session-status class="mb-5" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5" x-data="{ showPassword: false, submitting: false }" x-on:submit="submitting = true">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="mt-2 block w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <div class="flex items-center justify-between">
                <x-input-label for="password" :value="__('Password')" />
                @if (Route::has('password.request'))
                    <a class="text-sm font-semibold text-cyan-700 transition hover:text-cyan-900 dark:text-cyan-300 dark:hover:text-cyan-100" href="{{ route('password.request') }}">
                        {{ __('Forgot?') }}
                    </a>
                @endif
            </div>

            <div class="relative mt-2">
                <x-text-input id="password" type="password" class="block w-full pe-12" x-bind:type="showPassword ? 'text' : 'password'" name="password" required autocomplete="current-password" />
                <button type="button" x-on:click="showPassword = ! showPassword" class="absolute inset-y-0 right-3 flex items-center text-slate-500 transition hover:text-slate-900 dark:text-slate-400 dark:hover:text-white">
                    <span class="sr-only">{{ __('Toggle password visibility') }}</span>
                    <svg x-show="! showPassword" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                    </svg>
                    <svg x-show="showPassword" x-cloak class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m3 3 18 18M10.6 10.6A3 3 0 0 0 13.4 13.4M8.4 5.5A10.8 10.8 0 0 1 12 5c6.5 0 10 7 10 7a18 18 0 0 1-3.2 4.1M6.1 6.8A17.5 17.5 0 0 0 2 12s3.5 7 10 7c1.4 0 2.7-.3 3.8-.8" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <label for="remember_me" class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50/80 px-4 py-3 dark:border-slate-800 dark:bg-slate-950/50">
            <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-cyan-600 shadow-sm focus:ring-cyan-500 dark:border-slate-700 dark:bg-slate-900 dark:focus:ring-cyan-400" name="remember">
            <span class="text-sm font-semibold text-slate-600 dark:text-slate-300">{{ __('Remember this browser') }}</span>
        </label>

        <x-primary-button class="w-full justify-center" x-bind:disabled="submitting">
            <span x-show="! submitting">{{ __('Log in') }}</span>
            <span x-show="submitting" x-cloak>{{ __('Checking...') }}</span>
        </x-primary-button>

        <p class="text-center text-sm text-slate-600 dark:text-slate-300">
            {{ __('New here?') }}
            <a href="{{ route('register') }}" class="font-semibold text-cyan-700 transition hover:text-cyan-900 dark:text-cyan-300 dark:hover:text-cyan-100">{{ __('Create account') }}</a>
        </p>
    </form>
</x-guest-layout>
