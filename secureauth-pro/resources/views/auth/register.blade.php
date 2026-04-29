<x-guest-layout>
    <div class="mb-6">
        <p class="text-sm font-semibold uppercase text-cyan-700 dark:text-cyan-300">Create account</p>
        <h1 class="mt-2 text-3xl font-extrabold text-slate-950 dark:text-white">Start protected</h1>
        <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">Your dashboard opens after email verification and OTP.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5" x-data="{ showPassword: false, submitting: false }" x-on:submit="submitting = true">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="mt-2 block w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="mt-2 block w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" />
            <div class="relative mt-2">
                <x-text-input id="password" type="password" class="block w-full pe-12" x-bind:type="showPassword ? 'text' : 'password'" name="password" required autocomplete="new-password" />
                <button type="button" x-on:click="showPassword = ! showPassword" class="absolute inset-y-0 right-3 flex items-center text-slate-500 transition hover:text-slate-900 dark:text-slate-400 dark:hover:text-white">
                    <span class="sr-only">{{ __('Toggle password visibility') }}</span>
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" type="password" class="mt-2 block w-full" x-bind:type="showPassword ? 'text' : 'password'" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <x-primary-button class="w-full justify-center" x-bind:disabled="submitting">
            <span x-show="! submitting">{{ __('Register') }}</span>
            <span x-show="submitting" x-cloak>{{ __('Creating...') }}</span>
        </x-primary-button>

        <p class="text-center text-sm text-slate-600 dark:text-slate-300">
            {{ __('Already registered?') }}
            <a class="font-semibold text-cyan-700 transition hover:text-cyan-900 dark:text-cyan-300 dark:hover:text-cyan-100" href="{{ route('login') }}">{{ __('Log in') }}</a>
        </p>
    </form>
</x-guest-layout>
