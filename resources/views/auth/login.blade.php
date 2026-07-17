<x-guest-layout>
    <h1 class="font-display text-2xl font-bold text-meadow-dark text-center mb-6">Selamat Datang Kembali!</h1>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block font-display text-sm font-semibold text-cocoa-dark mb-1">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                   class="w-full px-4 py-2.5 rounded-xl border border-sky-light focus:border-meadow focus:ring-1 focus:ring-meadow focus:outline-none font-body">
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <div>
            <label for="password" class="block font-display text-sm font-semibold text-cocoa-dark mb-1">Password</label>
            <input id="password" type="password" name="password" required
                   class="w-full px-4 py-2.5 rounded-xl border border-sky-light focus:border-meadow focus:ring-1 focus:ring-meadow focus:outline-none font-body">
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 text-sm font-body text-cocoa-dark">
                <input type="checkbox" name="remember" class="rounded border-sky-light text-meadow focus:ring-meadow">
                Ingat saya
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm font-body text-sky hover:text-meadow transition">
                    Lupa password?
                </a>
            @endif
        </div>

        <button type="submit"
                class="w-full py-3 rounded-full bg-meadow text-white font-display font-semibold shadow-md hover:bg-meadow-dark transition">
            Masuk
        </button>

        <p class="text-center text-sm font-body text-cocoa-dark/70">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-bubblegum font-semibold hover:underline">Daftar di sini</a>
        </p>
    </form>
</x-guest-layout>