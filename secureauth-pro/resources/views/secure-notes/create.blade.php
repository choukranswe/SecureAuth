<x-app-layout>
    <div class="mx-auto max-w-3xl space-y-6 px-4 py-8 sm:px-6 lg:px-8">
        <div>
            <p class="text-sm font-semibold uppercase text-cyan-600 dark:text-cyan-400">New entry</p>
            <h1 class="mt-2 text-3xl font-bold text-slate-950 dark:text-white">Create SecureNote</h1>
        </div>

        @include('secure-notes._form')
    </div>
</x-app-layout>
