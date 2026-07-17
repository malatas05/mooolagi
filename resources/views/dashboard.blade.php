<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display font-semibold text-xl text-meadow-dark">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl border-2 border-sky-light p-6 mb-8">
                <p class="font-body text-cocoa-dark">
                    Halo, <span class="font-semibold">{{ Auth::user()->name }}</span>! Berikut riwayat custom request kamu.
                </p>
            </div>

            @if ($customRequests->isEmpty())
                <div class="bg-white rounded-2xl border-2 border-sky-light p-10 text-center">
                    <p class="font-display text-cocoa-dark/60">Belum ada request yang diajukan.</p>
                    <a href="{{ route('catalog') }}" class="inline-block mt-4 px-6 py-2.5 rounded-full bg-meadow text-white font-display font-semibold text-sm hover:bg-meadow-dark transition">
                        Lihat Katalog
                    </a>
                </div>
            @else
                <div class="space-y-4">
                    @foreach ($customRequests as $request)
                        <a href="{{ route('requests.show', $request) }}"
                           class="block bg-white rounded-2xl border-2 border-sky-light p-5 hover:border-meadow transition">
                            <div class="flex items-center justify-between gap-4">
                                <div>
                                    <p class="font-display font-semibold text-cocoa-dark">{{ $request->product->name }}</p>
                                    <p class="text-sm font-body text-cocoa-dark/60 mt-1">
                                        Diajukan {{ $request->created_at->translatedFormat('d M Y') }}
                                    </p>
                                </div>
                                <span class="text-xs font-display font-semibold px-3 py-1.5 rounded-full whitespace-nowrap {{ $request->status_badge_class }}">
                                    {{ $request->status_label }}
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $customRequests->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>