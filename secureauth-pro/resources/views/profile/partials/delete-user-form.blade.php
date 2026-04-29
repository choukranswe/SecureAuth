<section class="space-y-5">
    <header>
        <h2 class="text-xl font-bold text-rose-950 dark:text-rose-100">{{ __('Delete account') }}</h2>
        <p class="mt-1 text-sm text-rose-800/80 dark:text-rose-200/80">{{ __('This permanently removes the user and cascades their SecureNotes.') }}</p>
    </header>

    <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
        {{ __('Delete account') }}
    </x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-xl font-bold text-slate-950 dark:text-white">{{ __('Confirm account deletion') }}</h2>
            <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">{{ __('Enter your password to permanently delete this account.') }}</p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />
                <x-text-input id="password" name="password" type="password" class="mt-2 block w-full" placeholder="{{ __('Password') }}" />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">{{ __('Cancel') }}</x-secondary-button>
                <x-danger-button>{{ __('Delete account') }}</x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
