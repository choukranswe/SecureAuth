<x-app-layout>
    <div class="mx-auto max-w-4xl space-y-6 px-4 py-8 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase text-emerald-600 dark:text-emerald-400">Authorized owner</p>
                <h1 class="mt-2 text-3xl font-bold text-slate-950 dark:text-white">{{ $note->title }}</h1>
                <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">{{ __('Created') }} {{ $note->created_at->format('M d, Y H:i') }}</p>
            </div>

            <div class="flex flex-wrap gap-3">
                <a href="{{ route('secure-notes.edit', $note) }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800">
                    {{ __('Edit') }}
                </a>

                <form method="POST" action="{{ route('secure-notes.destroy', $note) }}" x-data="{ deleting: false }" x-on:submit="deleting = true">
                    @csrf
                    @method('DELETE')
                    <button type="submit" x-bind:disabled="deleting" class="inline-flex items-center justify-center rounded-2xl bg-rose-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-rose-700 disabled:cursor-not-allowed disabled:opacity-60">
                        <span x-show="! deleting">{{ __('Delete') }}</span>
                        <span x-show="deleting" x-cloak>{{ __('Deleting...') }}</span>
                    </button>
                </form>
            </div>
        </div>

        <article class="rounded-2xl border border-white/70 bg-white/90 p-6 shadow-xl shadow-slate-200/60 backdrop-blur dark:border-slate-800 dark:bg-slate-900/80 dark:shadow-black/20">
            <div class="prose max-w-none whitespace-pre-line text-slate-700 dark:text-slate-200">{{ $note->content }}</div>
        </article>

        <a href="{{ route('secure-notes.index') }}" class="inline-flex text-sm font-semibold text-cyan-700 transition hover:text-cyan-900 dark:text-cyan-300 dark:hover:text-cyan-100">
            {{ __('Back to SecureNotes') }}
        </a>
    </div>
</x-app-layout>
