<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <div class="flex flex-col md:flex-row gap-4 items-center justify-between mb-8">
        <div class="flex flex-wrap gap-2">
            <button wire:click="$set('categorySlug', '')"
                    class="px-4 py-2 rounded-full text-sm font-display font-semibold transition
                    {{ $categorySlug === '' ? 'bg-meadow text-white' : 'bg-white border border-sky-light text-cocoa-dark hover:border-meadow' }}">
                Semua
            </button>
            @foreach ($categories as $category)
                <button wire:click="$set('categorySlug', '{{ $category->slug }}')"
                        class="px-4 py-2 rounded-full text-sm font-display font-semibold transition
                        {{ $categorySlug === $category->slug ? 'bg-meadow text-white' : 'bg-white border border-sky-light text-cocoa-dark hover:border-meadow' }}">
                    {{ $category->name }}
                </button>
            @endforeach
        </div>

        <input type="text" wire:model.live.debounce.400ms="search" placeholder="Cari produk..."
               class="w-full md:w-64 px-4 py-2 rounded-full border border-sky-light focus:border-meadow focus:outline-none font-body text-sm">
    </div>

    @if ($products->isEmpty())
        <div class="text-center py-20">
            <p class="font-display text-lg text-cocoa-dark/60">Belum ada produk yang cocok.</p>
        </div>
    @else
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach ($products as $product)
                <a href="{{ route('products.show', $product) }}"
                   class="bg-white rounded-2xl border-2 border-sky-light overflow-hidden shadow-sm hover:shadow-lg hover:-translate-y-1 transition block">
                    <div class="aspect-square bg-sky-light flex items-center justify-center overflow-hidden">
                        @if ($product->images->isNotEmpty())
                            <img src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                                 alt="{{ $product->name }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-cocoa-dark/30 text-sm font-body">Belum ada foto</span>
                        @endif
                    </div>
                    <div class="p-4">
                        <span class="text-xs font-display font-semibold text-bubblegum">{{ $product->category->name }}</span>
                        <h3 class="font-display font-semibold text-cocoa-dark mt-1 truncate">{{ $product->name }}
                            @if ($product->price)
    <p class="text-sm font-body font-semibold text-meadow-dark mt-1">{{ $product->formatted_price }}</p>
@endif
                        </h3>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="mt-10">
            {{ $products->links() }}
        </div>
    @endif
</div>