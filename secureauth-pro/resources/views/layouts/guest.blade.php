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
    <body class="h-full font-sans text-slate-900 antialiased dark:text-slate-100">
        <div class="grid min-h-screen bg-[linear-gradient(135deg,#f8fafc_0%,#ecfeff_45%,#f1f5f9_100%)] lg:grid-cols-[minmax(0,1fr)_500px] dark:bg-[linear-gradient(135deg,#020617_0%,#083344_50%,#0f172a_100%)]">
            <section class="relative hidden overflow-hidden p-10 lg:flex lg:flex-col lg:justify-between">
                <a href="/" class="flex w-fit items-center gap-3">
                    <x-application-logo class="h-12 w-12" />
                    <div>
                        <p class="text-xl font-extrabold text-slate-950 dark:text-white">SecureAuth Pro</p>
                        <p class="text-sm font-semibold text-cyan-700 dark:text-cyan-300">Laravel security lab</p>
                    </div>
                </a>

                <div class="max-w-2xl">
                    <p class="text-sm font-semibold uppercase text-cyan-700 dark:text-cyan-300">Protected identity flow</p>
                    <h1 class="mt-4 text-5xl font-extrabold leading-tight text-slate-950 dark:text-white">Modern authentication with a second email factor.</h1>
                    <p class="mt-5 text-lg leading-8 text-slate-600 dark:text-slate-300">Email verification, one-time login codes, verified sessions, and owner-only authorization live in one focused Laravel project.</p>
                </div>

                <div class="grid max-w-3xl gap-4 md:grid-cols-3">
                    <div class="rounded-2xl border border-white/70 bg-white/75 p-4 shadow-lg shadow-slate-200/60 backdrop-blur dark:border-slate-800 dark:bg-slate-900/70 dark:shadow-black/20">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700 dark:bg-emerald-950 dark:text-emerald-300">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4L19 6" /></svg>
                        </div>
                        <p class="mt-4 text-sm font-bold text-slate-950 dark:text-white">Verified email</p>
                    </div>
                    <div class="rounded-2xl border border-white/70 bg-white/75 p-4 shadow-lg shadow-slate-200/60 backdrop-blur dark:border-slate-800 dark:bg-slate-900/70 dark:shadow-black/20">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-cyan-100 text-cyan-700 dark:bg-cyan-950 dark:text-cyan-300">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 17v.01M8 10V8a4 4 0 1 1 8 0v2m-9 0h10v10H7V10Z" /></svg>
                        </div>
                        <p class="mt-4 text-sm font-bold text-slate-950 dark:text-white">OTP challenge</p>
                    </div>
                    <div class="rounded-2xl border border-white/70 bg-white/75 p-4 shadow-lg shadow-slate-200/60 backdrop-blur dark:border-slate-800 dark:bg-slate-900/70 dark:shadow-black/20">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-100 text-amber-700 dark:bg-amber-950 dark:text-amber-300">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M7 3h7l4 4v14H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M14 3v5h5" /></svg>
                        </div>
                        <p class="mt-4 text-sm font-bold text-slate-950 dark:text-white">Policy notes</p>
                    </div>
                </div>
            </section>

            <main class="flex min-h-screen items-center justify-center px-4 py-8 sm:px-6">
                <div class="w-full max-w-md">
                    <div class="mb-8 flex items-center justify-center gap-3 lg:hidden">
                        <a href="/" class="flex items-center gap-3">
                            <x-application-logo class="h-11 w-11" />
                            <span class="text-xl font-extrabold text-slate-950 dark:text-white">SecureAuth Pro</span>
                        </a>
                    </div>

                    <div class="rounded-2xl border border-white/70 bg-white/90 p-6 shadow-2xl shadow-slate-300/50 backdrop-blur dark:border-slate-800 dark:bg-slate-900/85 dark:shadow-black/30 sm:p-8">
                        {{ $slot }}
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
