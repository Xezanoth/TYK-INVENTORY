<x-guest-layout title="Sign in">
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <div class="mb-8">
        <p class="text-sm font-semibold text-emerald-700">Welcome back</p>
        <h2 class="mt-2 text-3xl font-bold tracking-tight text-slate-950">Sign in to your account</h2>
        <p class="mt-2 text-sm leading-6 text-slate-500">Enter your details to access your inventory workspace.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email address')" class="mb-2 text-sm font-semibold text-slate-700" />
            <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="you@company.com"
                class="block w-full rounded-xl border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm placeholder:text-slate-400 focus:border-emerald-500 focus:ring-emerald-500">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <div class="mb-2 flex items-center justify-between gap-3">
                <x-input-label for="password" :value="__('Password')" class="text-sm font-semibold text-slate-700" />
                @if (Route::has('password.request'))
                    <a class="rounded text-xs font-semibold text-emerald-700 hover:text-emerald-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2" href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>
            <input id="password" name="password" type="password" required autocomplete="current-password" placeholder="Enter your password"
                class="block w-full rounded-xl border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm placeholder:text-slate-400 focus:border-emerald-500 focus:ring-emerald-500">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <label for="remember_me" class="inline-flex cursor-pointer items-center gap-2.5">
            <input id="remember_me" type="checkbox" name="remember" class="rounded border-slate-300 text-emerald-600 shadow-sm focus:ring-emerald-500">
            <span class="text-sm text-slate-600">{{ __('Remember me') }}</span>
        </label>

        <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-emerald-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-emerald-600/20 transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:ring-offset-2">
            {{ __('Sign in') }}
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M5 12h14m-6-6 6 6-6 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
    </form>

    @if (Route::has('register'))
        <p class="mt-7 text-center text-sm text-slate-500">
            New to {{ shop_name() }}?
            <a href="{{ route('register') }}" class="font-semibold text-emerald-700 hover:text-emerald-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">{{ __('Create an account') }}</a>
        </p>
    @endif
</x-guest-layout>
