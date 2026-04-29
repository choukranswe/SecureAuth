<section>
    <header class="flex items-start justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-slate-950 dark:text-white">{{ __('Profile information') }}</h2>
            <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">{{ __('Keep your account identity current.') }}</p>
        </div>

        <span class="rounded-full {{ $user->hasVerifiedEmail() ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-950 dark:text-emerald-300' : 'bg-amber-100 text-amber-700 dark:bg-amber-950 dark:text-amber-300' }} px-3 py-1 text-xs font-semibold">
            {{ $user->hasVerifiedEmail() ? __('Email verified') : __('Email pending') }}
        </span>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-5" x-data="{ saving: false }" x-on:submit="saving = true">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-2 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-2 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 rounded-2xl border border-amber-200 bg-amber-50 p-4 text-sm text-amber-800 dark:border-amber-900/70 dark:bg-amber-950/30 dark:text-amber-200">
                    <p class="font-semibold">{{ __('Your email address is unverified.') }}</p>
                    <button form="send-verification" class="mt-2 font-semibold underline decoration-amber-400 underline-offset-4">
                        {{ __('Resend verification email') }}
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-semibold text-emerald-700 dark:text-emerald-300">{{ __('Verification link sent.') }}</p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
            <x-primary-button x-bind:disabled="saving">
                <span x-show="! saving">{{ __('Save profile') }}</span>
                <span x-show="saving" x-cloak>{{ __('Saving...') }}</span>
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2200)" class="text-sm font-semibold text-emerald-700 dark:text-emerald-300">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
