<x-guest-layout>
    <h1 class="font-display text-2xl font-bold text-meadow-dark text-center mb-6">Buat Akun Baru</h1>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <label for="name" class="block font-display text-sm font-semibold text-cocoa-dark mb-1">Nama Lengkap</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                   class="w-full px-4 py-2.5 rounded-xl border border-sky-light focus:border-meadow focus:ring-1 focus:ring-meadow focus:outline-none font-body">
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        <div>
            <label for="email" class="block font-display text-sm font-semibold text-cocoa-dark mb-1">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                   class="w-full px-4 py-2.5 rounded-xl border border-sky-light focus:border-meadow focus:ring-1 focus:ring-meadow focus:outline-none font-body">
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <div>
            <label for="password" class="block font-display text-sm font-semibold text-cocoa-dark mb-1">Password</label>
            <input id="password" type="password" name="password" required
                   class="w-full px-4 py-2.5 rounded-xl border border-sky-light focus:border-meadow focus:ring-1 focus:ring-meadow focus:outline-none font-body">
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <div>
            <label for="password_confirmation" class="block font-display text-sm font-semibold text-cocoa-dark mb-1">Konfirmasi Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                   class="w-full px-4 py-2.5 rounded-xl border border-sky-light focus:border-meadow focus:ring-1 focus:ring-meadow focus:outline-none font-body">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <button type="submit"
                class="w-full py-3 rounded-full bg-bubblegum text-white font-display font-semibold shadow-md hover:opacity-90 transition">
            Daftar Sekarang
        </button>

        <p class="text-center text-sm font-body text-cocoa-dark/70">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-meadow font-semibold hover:underline">Masuk di sini</a>
        </p>
    </form>
</x-guest-layout>