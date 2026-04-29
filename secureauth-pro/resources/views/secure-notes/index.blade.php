<x-app-layout>
    <div class="mx-auto max-w-7xl space-y-8 px-4 py-8 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase text-cyan-600 dark:text-cyan-400">Private vault</p>
                <h1 class="mt-2 text-3xl font-bold text-slate-950 dark:text-white">SecureNotes</h1>
                <p class="mt-2 max-w-2xl text-sm text-slate-600 dark:text-slate-300">Encrypted-thinking space for account-only notes protected by Laravel authorization.</p>
            </div>

            <a href="{{ route('secure-notes.create') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-slate-950 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-slate-900/20 transition hover:-translate-y-0.5 hover:bg-cyan-700 dark:bg-cyan-500 dark:text-slate-950 dark:shadow-cyan-900/30 dark:hover:bg-cyan-300">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m7-7H5" />
                </svg>
                {{ __('New secure note') }}
            </a>
        </div>

        @if ($notes->isEmpty())
            <div class="rounded-2xl border border-dashed border-cyan-200 bg-cyan-50/60 p-10 text-center shadow-sm dark:border-cyan-900/70 dark:bg-cyan-950/20">
                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-white text-cyan-600 shadow-sm dark:bg-slate-900 dark:text-cyan-300">
                    <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 3h7l4 4v14H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 3v5h5M9 13h6M9 17h4" />
                    </svg>
                </div>
                <h2 class="mt-5 text-xl font-semibold text-slate-950 dark:text-white">No secure notes yet</h2>
                <p class="mx-auto mt-2 max-w-md text-sm text-slate-600 dark:text-slate-300">Create your first note and Laravel will attach it to your user account automatically.</p>
                <a href="{{ route('secure-notes.create') }}" class="mt-6 inline-flex items-center justify-center rounded-2xl bg-cyan-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-cyan-700 dark:bg-cyan-400 dark:text-slate-950 dark:hover:bg-cyan-300">
                    {{ __('Create first note') }}
                </a>
            </div>
        @else
            <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($notes as $note)
                    <article class="group rounded-2xl border border-white/70 bg-white/85 p-5 shadow-lg shadow-slate-200/60 transition hover:-translate-y-1 hover:shadow-xl dark:border-slate-800 dark:bg-slate-900/80 dark:shadow-black/20">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-xs font-semibold uppercase text-emerald-600 dark:text-emerald-400">Owner verified</p>
                                <h2 class="mt-2 line-clamp-2 text-lg font-semibold text-slate-950 dark:text-white">
                                    <a href="{{ route('secure-notes.show', $note) }}" class="transition group-hover:text-cyan-700 dark:group-hover:text-cyan-300">{{ $note->title }}</a>
                                </h2>
                            </div>
                            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600 dark:bg-slate-800 dark:text-slate-300">{{ $note->created_at->diffForHumans() }}</span>
                        </div>

                        <p class="mt-4 line-clamp-4 text-sm leading-6 text-slate-600 dark:text-slate-300">{{ $note->content }}</p>

                        <div class="mt-5 flex items-center justify-between border-t border-slate-100 pt-4 dark:border-slate-800">
                            <a href="{{ route('secure-notes.show', $note) }}" class="text-sm font-semibold text-cyan-700 transition hover:text-cyan-900 dark:text-cyan-300 dark:hover:text-cyan-100">{{ __('Open') }}</a>
                            <a href="{{ route('secure-notes.edit', $note) }}" class="text-sm font-semibold text-slate-500 transition hover:text-slate-900 dark:text-slate-400 dark:hover:text-white">{{ __('Edit') }}</a>
                        </div>
                    </article>
                @endforeach
            </div>

            <div>
                {{ $notes->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
