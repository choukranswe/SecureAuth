@php
    $note = $note ?? null;
    $isEditing = filled($note);
@endphp

<div class="rounded-2xl border border-white/70 bg-white/85 p-6 shadow-xl shadow-slate-200/60 backdrop-blur dark:border-slate-800 dark:bg-slate-900/80 dark:shadow-black/20">
    <form
        method="POST"
        action="{{ $isEditing ? route('secure-notes.update', $note) : route('secure-notes.store') }}"
        class="space-y-6"
        x-data="{ saving: false }"
        x-on:submit="saving = true"
    >
        @csrf
        @if ($isEditing)
            @method('PUT')
        @endif

        <div>
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input
                id="title"
                name="title"
                type="text"
                class="mt-2 block w-full"
                :value="old('title', $note?->title)"
                maxlength="120"
                required
                autofocus
            />
            <x-input-error class="mt-2" :messages="$errors->get('title')" />
        </div>

        <div>
            <x-input-label for="content" :value="__('Content')" />
            <textarea
                id="content"
                name="content"
                rows="10"
                class="mt-2 block w-full rounded-2xl border-slate-200 bg-white/90 text-slate-900 shadow-sm transition focus:border-cyan-500 focus:ring-cyan-500 dark:border-slate-700 dark:bg-slate-950/80 dark:text-slate-100 dark:focus:border-cyan-400 dark:focus:ring-cyan-400"
                required
            >{{ old('content', $note?->content) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('content')" />
        </div>

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <a href="{{ $isEditing ? route('secure-notes.show', $note) : route('secure-notes.index') }}" class="text-sm font-semibold text-slate-500 transition hover:text-slate-900 dark:text-slate-400 dark:hover:text-white">
                {{ __('Cancel') }}
            </a>

            <x-primary-button x-bind:disabled="saving" class="justify-center">
                <span x-show="! saving">{{ $isEditing ? __('Update note') : __('Create note') }}</span>
                <span x-show="saving" x-cloak>{{ __('Saving...') }}</span>
            </x-primary-button>
        </div>
    </form>
</div>
