<x-app-layout>
    @php
        $user = auth()->user();
        $emailVerified = $user->hasVerifiedEmail();
        $accountProtected = $emailVerified && $otpVerified;
    @endphp

    <div class="mx-auto max-w-7xl space-y-8 px-4 py-8 sm:px-6 lg:px-8">
        <section class="overflow-hidden rounded-2xl border border-white/70 bg-slate-950 text-white shadow-2xl shadow-slate-300/50 dark:border-slate-800 dark:bg-slate-900 dark:shadow-black/30">
            <div class="grid gap-8 p-6 md:grid-cols-[minmax(0,1fr)_320px] md:p-8">
                <div>
                    <p class="text-sm font-semibold uppercase text-cyan-300">Security command center</p>
                    <h1 class="mt-3 text-4xl font-extrabold leading-tight">Your Laravel identity flow is active.</h1>
                    <p class="mt-4 max-w-2xl text-slate-300">SecureAuth Pro combines Breeze authentication, email verification, one-time login codes, route middleware, and policy-guarded notes.</p>
                    <div class="mt-6 flex flex-wrap gap-3">
                        <a href="{{ route('secure-notes.create') }}" class="inline-flex items-center justify-center rounded-2xl bg-cyan-400 px-5 py-3 text-sm font-semibold text-slate-950 shadow-lg shadow-cyan-950/30 transition hover:-translate-y-0.5 hover:bg-cyan-300">{{ __('Create note') }}</a>
                        <a href="{{ route('profile.edit') }}" class="inline-flex items-center justify-center rounded-2xl border border-white/20 px-5 py-3 text-sm font-semibold text-white transition hover:bg-white/10">{{ __('View profile') }}</a>
                    </div>
                </div>

                <div class="rounded-2xl border border-white/10 bg-white/10 p-5 backdrop-blur">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-semibold text-slate-200">Protected session</p>
                        <span class="rounded-full bg-emerald-400/20 px-3 py-1 text-xs font-semibold text-emerald-200">{{ $accountProtected ? __('Healthy') : __('Needs attention') }}</span>
                    </div>
                    <div class="mt-6 space-y-4">
                        <div>
                            <div class="flex justify-between text-sm">
                                <span>Email</span>
                                <span>{{ $emailVerified ? __('Verified') : __('Pending') }}</span>
                            </div>
                            <div class="mt-2 h-2 rounded-full bg-white/10"><div class="h-2 rounded-full {{ $emailVerified ? 'w-full bg-emerald-400' : 'w-1/2 bg-amber-300' }}"></div></div>
                        </div>
                        <div>
                            <div class="flex justify-between text-sm">
                                <span>OTP</span>
                                <span>{{ $otpVerified ? __('Verified') : __('Waiting') }}</span>
                            </div>
                            <div class="mt-2 h-2 rounded-full bg-white/10"><div class="h-2 rounded-full {{ $otpVerified ? 'w-full bg-cyan-300' : 'w-1/2 bg-amber-300' }}"></div></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
            <div class="rounded-2xl border border-white/70 bg-white/85 p-5 shadow-lg shadow-slate-200/60 dark:border-slate-800 dark:bg-slate-900/80 dark:shadow-black/20">
                <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">Email status</p>
                <div class="mt-4 flex items-center justify-between">
                    <p class="text-2xl font-extrabold text-slate-950 dark:text-white">{{ $emailVerified ? __('Verified') : __('Pending') }}</p>
                    <span class="rounded-full {{ $emailVerified ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-950 dark:text-emerald-300' : 'bg-amber-100 text-amber-700 dark:bg-amber-950 dark:text-amber-300' }} px-3 py-1 text-xs font-semibold">{{ $emailVerified ? __('OK') : __('Action') }}</span>
                </div>
            </div>

            <div class="rounded-2xl border border-white/70 bg-white/85 p-5 shadow-lg shadow-slate-200/60 dark:border-slate-800 dark:bg-slate-900/80 dark:shadow-black/20">
                <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">OTP status</p>
                <div class="mt-4 flex items-center justify-between">
                    <p class="text-2xl font-extrabold text-slate-950 dark:text-white">{{ $otpVerified ? __('Verified') : __('Required') }}</p>
                    <span class="rounded-full {{ $otpVerified ? 'bg-cyan-100 text-cyan-700 dark:bg-cyan-950 dark:text-cyan-300' : 'bg-amber-100 text-amber-700 dark:bg-amber-950 dark:text-amber-300' }} px-3 py-1 text-xs font-semibold">{{ __('Email OTP') }}</span>
                </div>
            </div>

            <div class="rounded-2xl border border-white/70 bg-white/85 p-5 shadow-lg shadow-slate-200/60 dark:border-slate-800 dark:bg-slate-900/80 dark:shadow-black/20">
                <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">Account</p>
                <div class="mt-4 flex items-center justify-between">
                    <p class="text-2xl font-extrabold text-slate-950 dark:text-white">{{ $accountProtected ? __('Protected') : __('Review') }}</p>
                    <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600 dark:bg-slate-800 dark:text-slate-300">Auth</span>
                </div>
            </div>

            <div class="rounded-2xl border border-white/70 bg-white/85 p-5 shadow-lg shadow-slate-200/60 dark:border-slate-800 dark:bg-slate-900/80 dark:shadow-black/20">
                <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">Secure notes</p>
                <div class="mt-4 flex items-center justify-between">
                    <p class="text-2xl font-extrabold text-slate-950 dark:text-white">{{ $notesCount }}</p>
                    <span class="rounded-full bg-violet-100 px-3 py-1 text-xs font-semibold text-violet-700 dark:bg-violet-950 dark:text-violet-300">{{ __('Policy') }}</span>
                </div>
            </div>
        </section>

        <section class="grid gap-6 xl:grid-cols-[minmax(0,1fr)_380px]">
            <div class="rounded-2xl border border-white/70 bg-white/85 p-6 shadow-xl shadow-slate-200/60 dark:border-slate-800 dark:bg-slate-900/80 dark:shadow-black/20">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold uppercase text-cyan-700 dark:text-cyan-300">Recent SecureNotes</p>
                        <h2 class="mt-2 text-2xl font-bold text-slate-950 dark:text-white">Latest private entries</h2>
                    </div>
                    <a href="{{ route('secure-notes.index') }}" class="text-sm font-semibold text-cyan-700 transition hover:text-cyan-900 dark:text-cyan-300 dark:hover:text-cyan-100">{{ __('View all') }}</a>
                </div>

                @if ($recentNotes->isEmpty())
                    <div class="mt-6 rounded-2xl border border-dashed border-slate-200 bg-slate-50 p-8 text-center dark:border-slate-700 dark:bg-slate-950/40">
                        <p class="font-semibold text-slate-950 dark:text-white">No notes yet</p>
                        <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">Your first SecureNote will appear here.</p>
                    </div>
                @else
                    <div class="mt-6 divide-y divide-slate-100 dark:divide-slate-800">
                        @foreach ($recentNotes as $note)
                            <a href="{{ route('secure-notes.show', $note) }}" class="block py-4 transition hover:bg-slate-50 dark:hover:bg-slate-950/40 sm:px-3 sm:rounded-2xl">
                                <div class="flex items-center justify-between gap-4">
                                    <div>
                                        <p class="font-semibold text-slate-950 dark:text-white">{{ $note->title }}</p>
                                        <p class="mt-1 line-clamp-1 text-sm text-slate-500 dark:text-slate-400">{{ $note->content }}</p>
                                    </div>
                                    <span class="shrink-0 text-xs font-semibold text-slate-400">{{ $note->updated_at->diffForHumans() }}</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="space-y-6">
                <div class="rounded-2xl border border-white/70 bg-white/85 p-6 shadow-xl shadow-slate-200/60 dark:border-slate-800 dark:bg-slate-900/80 dark:shadow-black/20">
                    <p class="text-sm font-semibold uppercase text-emerald-700 dark:text-emerald-300">Security checklist</p>
                    <div class="mt-5 space-y-4">
                        @foreach ([
                            ['label' => __('Email verification'), 'done' => $emailVerified],
                            ['label' => __('OTP session verified'), 'done' => $otpVerified],
                            ['label' => __('Policy protected notes'), 'done' => true],
                        ] as $item)
                            <div class="flex items-center gap-3">
                                <span class="flex h-8 w-8 items-center justify-center rounded-xl {{ $item['done'] ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-950 dark:text-emerald-300' : 'bg-amber-100 text-amber-700 dark:bg-amber-950 dark:text-amber-300' }}">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['done'] ? 'm5 12 4 4L19 6' : 'M12 8v5m0 4v.01' }}" />
                                    </svg>
                                </span>
                                <span class="text-sm font-semibold text-slate-700 dark:text-slate-200">{{ $item['label'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="rounded-2xl border border-white/70 bg-white/85 p-6 shadow-xl shadow-slate-200/60 dark:border-slate-800 dark:bg-slate-900/80 dark:shadow-black/20">
                    <p class="text-sm font-semibold uppercase text-cyan-700 dark:text-cyan-300">Quick actions</p>
                    <div class="mt-5 grid gap-3">
                        <a href="{{ route('secure-notes.create') }}" class="rounded-2xl bg-slate-950 px-4 py-3 text-center text-sm font-semibold text-white transition hover:bg-cyan-700 dark:bg-cyan-400 dark:text-slate-950 dark:hover:bg-cyan-300">{{ __('Create note') }}</a>
                        <a href="{{ route('profile.edit') }}" class="rounded-2xl border border-slate-200 bg-white px-4 py-3 text-center text-sm font-semibold text-slate-700 transition hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800">{{ __('View profile') }}</a>
                        @unless ($emailVerified)
                            <form method="POST" action="{{ route('verification.send') }}">
                                @csrf
                                <button type="submit" class="w-full rounded-2xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm font-semibold text-amber-800 transition hover:bg-amber-100 dark:border-amber-900/70 dark:bg-amber-950/30 dark:text-amber-200">{{ __('Resend verification email') }}</button>
                            </form>
                        @endunless
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
