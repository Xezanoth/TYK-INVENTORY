@props(['title' => 'Secure access'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title }} · {{ shop_name() }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-slate-50 font-sans text-slate-900 antialiased">
        <main class="min-h-screen lg:grid lg:grid-cols-2">
            <section class="relative isolate overflow-hidden bg-slate-950 px-6 py-8 text-white sm:px-10 lg:flex lg:min-h-screen lg:flex-col lg:justify-between lg:px-14 lg:py-12 xl:px-20">
                <div class="pointer-events-none absolute -right-32 -top-40 -z-10 h-96 w-96 rounded-full bg-emerald-500/20 blur-3xl"></div>
                <div class="pointer-events-none absolute -bottom-48 -left-40 -z-10 h-96 w-96 rounded-full bg-teal-400/10 blur-3xl"></div>

                <a href="{{ url('/') }}" class="inline-flex w-fit items-center gap-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:ring-offset-4 focus:ring-offset-slate-950">
                    <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-400 text-slate-950 shadow-lg shadow-emerald-950/30">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M4 19V9.5L12 5l8 4.5V19H4Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                            <path d="M9 19v-6h6v6M8 10h.01M12 10h.01M16 10h.01" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                        </svg>
                    </span>
                    <span>
                        <span class="block text-sm font-extrabold tracking-[0.16em]">{{ shop_name() }}</span>
                        <span class="mt-0.5 block text-xs font-medium text-slate-400">Inventory management</span>
                    </span>
                </a>

                <div class="hidden max-w-xl py-16 lg:block">
                    <p class="mb-5 inline-flex items-center gap-2 rounded-full border border-emerald-400/20 bg-emerald-400/10 px-3 py-1.5 text-xs font-semibold uppercase tracking-[0.16em] text-emerald-300">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                        Your operations, in sync
                    </p>
                    <h1 class="max-w-lg text-5xl font-semibold leading-[1.12] tracking-tight xl:text-6xl">
                        Keep your stock moving.
                    </h1>
                    <p class="mt-6 max-w-md text-base leading-7 text-slate-400">
                        One clear view of your products, inventory, and day-to-day work—so you can focus on serving your customers.
                    </p>

                    <div class="mt-12 grid max-w-lg grid-cols-2 gap-3">
                        <div class="rounded-2xl border border-white/10 bg-white/[0.04] p-4">
                            <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-emerald-400/10 text-emerald-300">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="m4 7 8-4 8 4-8 4-8-4Z M4 12l8 4 8-4M4 17l8 4 8-4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <p class="mt-4 text-sm font-semibold">Inventory at a glance</p>
                            <p class="mt-1 text-xs leading-5 text-slate-400">Know what is in stock and what needs attention.</p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/[0.04] p-4">
                            <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-emerald-400/10 text-emerald-300">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M4 19V5m0 14h16M8 15l3-4 3 2 5-6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <p class="mt-4 text-sm font-semibold">Work that flows</p>
                            <p class="mt-1 text-xs leading-5 text-slate-400">Keep your team and daily operations connected.</p>
                        </div>
                    </div>
                </div>

                <p class="hidden text-xs text-slate-500 lg:block">A simpler way to manage your shop.</p>
            </section>

            <section class="flex min-h-[calc(100vh-7rem)] items-center justify-center px-5 py-10 sm:px-8 lg:min-h-screen lg:px-12">
                <div class="w-full max-w-md">
                    <div class="mb-8 lg:hidden">
                        <a href="{{ url('/') }}" class="inline-flex items-center gap-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:ring-offset-4">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-500 text-slate-950">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M4 19V9.5L12 5l8 4.5V19H4Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                                    <path d="M9 19v-6h6v6M8 10h.01M12 10h.01M16 10h.01" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                </svg>
                            </span>
                            <span class="text-sm font-extrabold tracking-[0.16em] text-slate-900">{{ shop_name() }}</span>
                        </a>
                    </div>

                    {{ $slot }}

                    <p class="mt-8 text-center text-xs text-slate-400">
                        &copy; {{ now()->year }} {{ shop_name() }}. All rights reserved.
                    </p>
                </div>
            </section>
        </main>
    </body>
</html>
