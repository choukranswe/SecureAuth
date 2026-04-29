<x-guest-layout>
    <div class="mb-6">
        <p class="text-sm font-semibold uppercase text-cyan-700 dark:text-cyan-300">Password recovery</p>
        <h1 class="mt-2 text-3xl font-extrabold text-slate-950 dark:text-white">Reset access</h1>
        <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">Laravel will send a signed reset link to your inbox.</p>
    </div>

    <x-auth-session-status class="mb-5" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5" x-data="{ submitting: false }" x-on:submit="submitting = true">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="mt-2 block w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <x-primary-button class="w-full justify-center" x-bind:disabled="submitting">
            <span x-show="! submitting">{{ __('Email reset link') }}</span>
            <span x-show="submitting" x-cloak>{{ __('Sending...') }}</span>
        </x-primary-button>

        <a href="{{ route('login') }}" class="block text-center text-sm font-semibold text-cyan-700 transition hover:text-cyan-900 dark:text-cyan-300 dark:hover:text-cyan-100">{{ __('Back to login') }}</a>
    </form>
</x-guest-layout>
