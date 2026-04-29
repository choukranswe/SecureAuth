<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'SecureAuth Pro') }}</title>

        <script>
            (function () {
                const stored = localStorage.getItem('secureauth_theme');
                const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

                if (stored === 'dark' || (! stored && prefersDark)) {
                    document.documentElement.classList.add('dark');
                }
            })();
        </script>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="min-h-screen bg-[linear-gradient(135deg,#f8fafc_0%,#ecfeff_46%,#f1f5f9_100%)] font-sans text-slate-950 antialiased dark:bg-[linear-gradient(135deg,#020617_0%,#083344_50%,#0f172a_100%)] dark:text-white">
        <header class="mx-auto flex max-w-7xl items-center justify-between px-4 py-6 sm:px-6 lg:px-8">
            <a href="/" class="flex items-center gap-3">
                <x-application-logo class="h-11 w-11" />
                <span class="text-xl font-extrabold">SecureAuth Pro</span>
            </a>

            <nav class="flex items-center gap-3">
                @auth
                    <a href="{{ route('dashboard') }}" class="rounded-2xl bg-slate-950 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-slate-900/20 transition hover:-translate-y-0.5 hover:bg-cyan-700 dark:bg-cyan-400 dark:text-slate-950 dark:shadow-cyan-950/30 dark:hover:bg-cyan-300">{{ __('Dashboard') }}</a>
                @else
                    <a href="{{ route('login') }}" class="rounded-2xl border border-slate-200 bg-white/80 px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-white dark:border-slate-700 dark:bg-slate-900/70 dark:text-slate-200 dark:hover:bg-slate-900">{{ __('Log in') }}</a>
                    <a href="{{ route('register') }}" class="hidden rounded-2xl bg-slate-950 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-slate-900/20 transition hover:-translate-y-0.5 hover:bg-cyan-700 sm:inline-flex dark:bg-cyan-400 dark:text-slate-950 dark:shadow-cyan-950/30 dark:hover:bg-cyan-300">{{ __('Register') }}</a>
                @endauth
            </nav>
        </header>

        <main>
            <section class="mx-auto max-w-7xl px-4 pb-12 pt-8 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-4xl text-center">
                    <p class="text-sm font-semibold uppercase text-cyan-700 dark:text-cyan-300">Laravel 12 authentication mini-project</p>
                    <h1 class="mt-5 text-5xl font-extrabold leading-tight sm:text-6xl">SecureAuth Pro</h1>
                    <p class="mx-auto mt-5 max-w-2xl text-lg leading-8 text-slate-600 dark:text-slate-300">A polished security-focused Laravel app with Breeze auth, verified email, email OTP, protected routes, and owner-only SecureNotes.</p>
                    <div class="mt-8 flex flex-col justify-center gap-3 sm:flex-row">
                        @auth
                            <a href="{{ route('dashboard') }}" class="rounded-2xl bg-slate-950 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-slate-900/20 transition hover:-translate-y-0.5 hover:bg-cyan-700 dark:bg-cyan-400 dark:text-slate-950 dark:shadow-cyan-950/30 dark:hover:bg-cyan-300">{{ __('Open dashboard') }}</a>
                        @else
                            <a href="{{ route('register') }}" class="rounded-2xl bg-slate-950 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-slate-900/20 transition hover:-translate-y-0.5 hover:bg-cyan-700 dark:bg-cyan-400 dark:text-slate-950 dark:shadow-cyan-950/30 dark:hover:bg-cyan-300">{{ __('Create secure account') }}</a>
                            <a href="{{ route('login') }}" class="rounded-2xl border border-slate-200 bg-white/80 px-6 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-white dark:border-slate-700 dark:bg-slate-900/70 dark:text-slate-200 dark:hover:bg-slate-900">{{ __('Log in') }}</a>
                        @endauth
                    </div>
                </div>

                <div class="mx-auto mt-12 grid max-w-5xl gap-4 rounded-2xl border border-white/70 bg-white/70 p-4 shadow-2xl shadow-slate-300/50 backdrop-blur dark:border-slate-800 dark:bg-slate-900/70 dark:shadow-black/30 md:grid-cols-3">
                    <div class="rounded-2xl bg-slate-950 p-5 text-white dark:bg-slate-950">
                        <p class="text-sm font-semibold text-cyan-300">Email verified</p>
                        <p class="mt-6 text-3xl font-extrabold">MustVerifyEmail</p>
                        <div class="mt-6 h-2 rounded-full bg-white/10"><div class="h-2 w-full rounded-full bg-emerald-400"></div></div>
                    </div>
                    <div class="rounded-2xl border border-slate-100 bg-white p-5 dark:border-slate-800 dark:bg-slate-900">
                        <p class="text-sm font-semibold text-cyan-700 dark:text-cyan-300">OTP challenge</p>
                        <p class="mt-6 text-3xl font-extrabold">6 digits</p>
                        <p class="mt-3 text-sm text-slate-500 dark:text-slate-400">Expires after 10 minutes</p>
                    </div>
                    <div class="rounded-2xl border border-slate-100 bg-white p-5 dark:border-slate-800 dark:bg-slate-900">
                        <p class="text-sm font-semibold text-violet-700 dark:text-violet-300">SecureNotes</p>
                        <p class="mt-6 text-3xl font-extrabold">Policy locked</p>
                        <p class="mt-3 text-sm text-slate-500 dark:text-slate-400">Owner view, update, delete</p>
                    </div>
                </div>
            </section>

            <section class="border-t border-white/60 bg-white/50 px-4 py-8 dark:border-slate-800 dark:bg-slate-950/40 sm:px-6 lg:px-8">
                <div class="mx-auto grid max-w-7xl gap-4 md:grid-cols-4">
                    @foreach (['Breeze Blade', 'Email verification', 'OTP middleware', 'Laravel policies'] as $item)
                        <div class="rounded-2xl border border-white/70 bg-white/80 p-4 text-sm font-semibold text-slate-700 shadow-sm dark:border-slate-800 dark:bg-slate-900/80 dark:text-slate-200">
                            {{ $item }}
                        </div>
                    @endforeach
                </div>
            </section>
        </main>
    </body>
</html>
