<section>
    <header>
        <h2 class="text-xl font-bold text-slate-950 dark:text-white">{{ __('Update password') }}</h2>
        <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">{{ __('Use a strong password alongside your email OTP flow.') }}</p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-5" x-data="{ showPassword: false, saving: false }" x-on:submit="saving = true">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current password')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" x-bind:type="showPassword ? 'text' : 'password'" class="mt-2 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('New password')" />
            <x-text-input id="update_password_password" name="password" type="password" x-bind:type="showPassword ? 'text' : 'password'" class="mt-2 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm password')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" x-bind:type="showPassword ? 'text' : 'password'" class="mt-2 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <label class="flex items-center gap-3 text-sm font-semibold text-slate-600 dark:text-slate-300">
            <input type="checkbox" x-model="showPassword" class="rounded border-slate-300 text-cyan-600 shadow-sm focus:ring-cyan-500 dark:border-slate-700 dark:bg-slate-900 dark:focus:ring-cyan-400">
            {{ __('Show password fields') }}
        </label>

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
            <x-primary-button x-bind:disabled="saving">
                <span x-show="! saving">{{ __('Save password') }}</span>
                <span x-show="saving" x-cloak>{{ __('Saving...') }}</span>
            </x-primary-button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2200)" class="text-sm font-semibold text-emerald-700 dark:text-emerald-300">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
