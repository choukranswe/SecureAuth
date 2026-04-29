<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

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
        <style>[x-cloak] { display: none !important; }</style>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="h-full font-sans antialiased">
        <div
            x-data="{
                sidebarOpen: false,
                profileOpen: false,
                darkMode: document.documentElement.classList.contains('dark'),
                toggleTheme() {
                    this.darkMode = ! this.darkMode;
                    document.documentElement.classList.toggle('dark', this.darkMode);
                    localStorage.setItem('secureauth_theme', this.darkMode ? 'dark' : 'light');
                }
            }"
            class="min-h-screen bg-[linear-gradient(135deg,#f8fafc_0%,#ecfeff_42%,#f1f5f9_100%)] text-slate-900 dark:bg-[linear-gradient(135deg,#020617_0%,#082f49_48%,#0f172a_100%)] dark:text-slate-100"
        >
            <div x-show="sidebarOpen" x-cloak class="fixed inset-0 z-40 bg-slate-950/50 lg:hidden" x-on:click="sidebarOpen = false"></div>

            <aside
                x-cloak
                class="fixed inset-y-0 left-0 z-50 w-72 transform border-r border-white/60 bg-white/80 px-4 py-5 shadow-2xl shadow-slate-300/50 backdrop-blur-xl transition lg:translate-x-0 dark:border-slate-800 dark:bg-slate-950/85 dark:shadow-black/30"
                :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
            >
                <div class="flex items-center justify-between">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                        <x-application-logo class="h-11 w-11" />
                        <div>
                            <p class="text-lg font-extrabold text-slate-950 dark:text-white">SecureAuth Pro</p>
                            <p class="text-xs font-semibold text-cyan-700 dark:text-cyan-300">Zero-trust workspace</p>
                        </div>
                    </a>
                    <button type="button" class="rounded-xl p-2 text-slate-500 transition hover:bg-slate-100 lg:hidden dark:hover:bg-slate-800" x-on:click="sidebarOpen = false">
                        <span class="sr-only">{{ __('Close navigation') }}</span>
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m6 6 12 12M18 6 6 18" />
                        </svg>
                    </button>
                </div>

                <nav class="mt-8 space-y-2">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold transition {{ request()->routeIs('dashboard') ? 'bg-slate-950 text-white shadow-lg shadow-slate-900/20 dark:bg-cyan-400 dark:text-slate-950 dark:shadow-cyan-950/30' : 'text-slate-600 hover:bg-white hover:text-slate-950 dark:text-slate-300 dark:hover:bg-slate-900 dark:hover:text-white' }}">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 13h7V4H4v9Zm9 7h7V4h-7v16ZM4 20h7v-5H4v5Z" />
                        </svg>
                        {{ __('Dashboard') }}
                    </a>

                    <a href="{{ route('secure-notes.index') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold transition {{ request()->routeIs('secure-notes.*') ? 'bg-slate-950 text-white shadow-lg shadow-slate-900/20 dark:bg-cyan-400 dark:text-slate-950 dark:shadow-cyan-950/30' : 'text-slate-600 hover:bg-white hover:text-slate-950 dark:text-slate-300 dark:hover:bg-slate-900 dark:hover:text-white' }}">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 3h7l4 4v14H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 3v5h5M9 13h6M9 17h4" />
                        </svg>
                        {{ __('SecureNotes') }}
                    </a>

                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold transition {{ request()->routeIs('profile.*') ? 'bg-slate-950 text-white shadow-lg shadow-slate-900/20 dark:bg-cyan-400 dark:text-slate-950 dark:shadow-cyan-950/30' : 'text-slate-600 hover:bg-white hover:text-slate-950 dark:text-slate-300 dark:hover:bg-slate-900 dark:hover:text-white' }}">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm7 8a7 7 0 0 0-14 0" />
                        </svg>
                        {{ __('Profile') }}
                    </a>
                </nav>

                <div class="absolute inset-x-4 bottom-5 rounded-2xl border border-cyan-100 bg-cyan-50/80 p-4 text-sm dark:border-cyan-900/70 dark:bg-cyan-950/30">
                    <p class="font-semibold text-slate-950 dark:text-white">{{ __('Session guard') }}</p>
                    <p class="mt-1 text-slate-600 dark:text-slate-300">{{ __('Email, OTP, and policies are active.') }}</p>
                </div>
            </aside>

            <div class="lg:pl-72">
                <header class="sticky top-0 z-30 border-b border-white/60 bg-white/75 backdrop-blur-xl dark:border-slate-800 dark:bg-slate-950/75">
                    <div class="flex h-20 items-center justify-between px-4 sm:px-6 lg:px-8">
                        <div class="flex items-center gap-3">
                            <button type="button" class="rounded-2xl border border-slate-200 bg-white p-3 text-slate-600 shadow-sm lg:hidden dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200" x-on:click="sidebarOpen = true">
                                <span class="sr-only">{{ __('Open navigation') }}</span>
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h16" />
                                </svg>
                            </button>
                            <div>
                                <p class="text-xs font-semibold uppercase text-cyan-700 dark:text-cyan-300">{{ __('Secure workspace') }}</p>
                                <p class="text-lg font-bold text-slate-950 dark:text-white">{{ __('Welcome back, :name', ['name' => Auth::user()->name]) }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <button type="button" x-on:click="toggleTheme()" class="rounded-2xl border border-slate-200 bg-white p-3 text-slate-600 shadow-sm transition hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800">
                                <span class="sr-only">{{ __('Toggle dark mode') }}</span>
                                <svg x-show="! darkMode" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2m0 14v2m9-9h-2M5 12H3m15.36-6.36-1.42 1.42M7.06 16.94l-1.42 1.42m12.72 0-1.42-1.42M7.06 7.06 5.64 5.64M12 8a4 4 0 1 0 0 8 4 4 0 0 0 0-8Z" />
                                </svg>
                                <svg x-show="darkMode" x-cloak class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12.8A8.5 8.5 0 1 1 11.2 3 6.5 6.5 0 0 0 21 12.8Z" />
                                </svg>
                            </button>

                            <div class="relative" x-on:click.outside="profileOpen = false">
                                <button type="button" x-on:click="profileOpen = ! profileOpen" class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-white px-3 py-2 shadow-sm transition hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:hover:bg-slate-800">
                                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-950 text-sm font-bold text-white dark:bg-cyan-400 dark:text-slate-950">{{ Str::of(Auth::user()->name)->substr(0, 1)->upper() }}</span>
                                    <span class="hidden text-left sm:block">
                                        <span class="block text-sm font-semibold text-slate-950 dark:text-white">{{ Auth::user()->name }}</span>
                                        <span class="block text-xs text-slate-500 dark:text-slate-400">{{ Auth::user()->email }}</span>
                                    </span>
                                </button>

                                <div x-show="profileOpen" x-cloak x-transition class="absolute right-0 mt-3 w-56 rounded-2xl border border-slate-200 bg-white p-2 shadow-xl shadow-slate-200/80 dark:border-slate-800 dark:bg-slate-900 dark:shadow-black/30">
                                    <a href="{{ route('profile.edit') }}" class="block rounded-xl px-3 py-2 text-sm font-semibold text-slate-600 transition hover:bg-slate-100 hover:text-slate-950 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white">{{ __('Profile settings') }}</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full rounded-xl px-3 py-2 text-left text-sm font-semibold text-rose-600 transition hover:bg-rose-50 dark:text-rose-300 dark:hover:bg-rose-950/30">{{ __('Log out') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>

                <x-alert />

                @isset($header)
                    <div class="mx-auto max-w-7xl px-4 pt-8 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                @endisset

                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
