<x-app-layout>
    <div class="mx-auto max-w-5xl space-y-8 px-4 py-8 sm:px-6 lg:px-8">
        <div>
            <p class="text-sm font-semibold uppercase text-cyan-700 dark:text-cyan-300">Account center</p>
            <h1 class="mt-2 text-3xl font-bold text-slate-950 dark:text-white">Profile settings</h1>
            <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">Identity, password, and account lifecycle controls.</p>
        </div>

        <div class="grid gap-6">
            <div class="rounded-2xl border border-white/70 bg-white/85 p-6 shadow-xl shadow-slate-200/60 dark:border-slate-800 dark:bg-slate-900/80 dark:shadow-black/20">
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="rounded-2xl border border-white/70 bg-white/85 p-6 shadow-xl shadow-slate-200/60 dark:border-slate-800 dark:bg-slate-900/80 dark:shadow-black/20">
                @include('profile.partials.update-password-form')
            </div>

            <div class="rounded-2xl border border-rose-200 bg-rose-50/70 p-6 shadow-xl shadow-rose-100/60 dark:border-rose-900/70 dark:bg-rose-950/20 dark:shadow-black/20">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
