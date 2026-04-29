@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700 dark:border-emerald-900/70 dark:bg-emerald-950/30 dark:text-emerald-300']) }}>
        {{ $status }}
    </div>
@endif
