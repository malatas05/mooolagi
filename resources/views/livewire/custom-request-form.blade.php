<div class="max-w-3xl mx-auto px-4 sm:px-6 py-12">

    <div class="mb-8">
        <a href="{{ route('products.show', $product) }}" class="text-sm font-body text-cocoa-dark/60 hover:text-meadow transition">&larr; Kembali ke produk</a>
        <h1 class="font-display text-3xl font-bold text-meadow-dark mt-2">Custom Request: {{ $product->name }}</h1>
        <p class="font-body text-cocoa-dark/70 mt-1">Isi detail di bawah ini dan lampirkan bukti transfer, tim kami akan segera konfirmasi pesananmu.</p>
    </div>

    <form wire:submit="submit" class="space-y-8">

        {{-- FIELD UMUM --}}
        <div class="bg-white rounded-2xl border-2 border-sky-light p-6 space-y-5">
    <h2 class="font-display font-semibold text-cocoa-dark">Informasi Umum</h2>

    <div>
        <label class="block font-display text-sm font-semibold text-cocoa-dark mb-1">Email Pengiriman Produk</label>
        <input type="email" wire:model="delivery_email"
               class="w-full px-4 py-2.5 rounded-xl border border-sky-light focus:border-meadow focus:ring-1 focus:ring-meadow focus:outline-none font-body">
        <p class="text-xs text-cocoa-dark/50 mt-1">Produk/konfirmasi pesanan akan dikirim ke email ini setelah pembayaran dikonfirmasi.</p>
        @error('delivery_email') <p class="text-bubblegum text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div class="bg-sunshine/10 border-2 border-sunshine rounded-xl p-4">
        <p class="font-display font-semibold text-sm text-cocoa-dark mb-2">Metode Pembayaran</p>
        <ul class="text-sm font-body text-cocoa-dark/80 space-y-1 list-disc list-inside">
            <li>Transfer Bank BCA — 7275042536 a/n Nalla</li>
            <li>Transfer Bank BNI — 1778941275 a/n Nalla</li>
            <li>E-Wallet (DANA, ShopeePay, OVO, GoPay) — 089603961169 a/n Nalla</li>
        </ul>
        <p class="text-xs font-body text-cocoa-dark/50 mt-2">*Silakan transfer sesuai total yang telah disepakati, lalu unggah buktinya di bawah ini.</p>
    </div>

    <div>
        <label class="block font-display text-sm font-semibold text-cocoa-dark mb-1">Foto Bukti Transfer</label>
                <input type="file" wire:model="payment_proof" accept="image/*"
                       class="w-full text-sm font-body">
                @error('payment_proof') <p class="text-bubblegum text-xs mt-1">{{ $message }}</p> @enderror
                @if ($payment_proof)
                    <img src="{{ $payment_proof->temporaryUrl() }}" class="mt-3 w-32 h-32 object-cover rounded-xl border-2 border-sky-light">
                @endif
            </div>

            <div>
                <label class="block font-display text-sm font-semibold text-cocoa-dark mb-1">Catatan Tambahan</label>
                <textarea wire:model="customer_notes" rows="3"
                          class="w-full px-4 py-2.5 rounded-xl border border-sky-light focus:border-meadow focus:ring-1 focus:ring-meadow focus:outline-none font-body"
                          placeholder="Ceritakan hal lain yang perlu kami tahu..."></textarea>
                @error('customer_notes') <p class="text-bubblegum text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        @if ($product->request_type === 'simple')
            <div class="bg-white rounded-2xl border-2 border-sky-light p-6 space-y-5">
                <h2 class="font-display font-semibold text-cocoa-dark">Detail Pesanan</h2>

                <div>
                    <label class="block font-display text-sm font-semibold text-cocoa-dark mb-1">Jumlah</label>
                    <input type="number" wire:model="quantity" min="1"
                           class="w-full px-4 py-2.5 rounded-xl border border-sky-light focus:border-meadow focus:ring-1 focus:ring-meadow focus:outline-none font-body">
                    @error('quantity') <p class="text-bubblegum text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        @else
            @foreach ($product->templateSections as $section)
                <div class="bg-white rounded-2xl border-2 border-bubblegum p-6 space-y-5">
                    <h2 class="font-display font-semibold text-bubblegum">{{ $section->name }}</h2>

                    @foreach ($section->slots as $slot)
                        <div class="border-t border-sky-light pt-4">
                            <p class="font-display text-sm font-semibold text-cocoa-dark mb-1">
                                {{ $slot->label }}
                                @if ($slot->quantity > 1)
                                    <span class="text-xs font-normal text-cocoa-dark/50">({{ $slot->quantity }}x)</span>
                                @endif
                            </p>
                            @if ($slot->instructions)
                                <p class="text-xs text-cocoa-dark/60 font-body mb-2">{{ $slot->instructions }}</p>
                            @endif

                            <div class="grid gap-3 {{ $slot->quantity > 1 ? 'md:grid-cols-2' : '' }}">
                                @for ($i = 0; $i < $slot->quantity; $i++)
                                    <div>
                                        @if ($slot->type === 'text')
                                            <textarea wire:model="slotTexts.{{ $slot->id }}.{{ $i }}" rows="2"
                                                      maxlength="{{ $slot->char_limit }}"
                                                      placeholder="{{ $slot->quantity > 1 ? 'Isian ke-' . ($i + 1) : 'Tulis di sini...' }}"
                                                      class="w-full px-4 py-2.5 rounded-xl border border-sky-light focus:border-bubblegum focus:ring-1 focus:ring-bubblegum focus:outline-none font-body text-sm"></textarea>
                                        @else
                                            <input type="file" wire:model="slotFiles.{{ $slot->id }}.{{ $i }}" accept="image/*"
                                                   class="w-full text-sm font-body">
                                            @if (isset($slotFiles[$slot->id][$i]))
                                                <img src="{{ $slotFiles[$slot->id][$i]->temporaryUrl() }}" class="mt-2 w-20 h-20 object-cover rounded-lg border-2 border-sky-light">
                                            @endif
                                            @if ($slot->size_spec)
                                                <p class="text-xs text-cocoa-dark/50 mt-1">Ukuran: {{ $slot->size_spec }}</p>
                                            @endif
                                        @endif
                                        @error("slotTexts.{$slot->id}.{$i}") <p class="text-bubblegum text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>
                                @endfor
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        @endif

        <button type="submit"
                wire:loading.attr="disabled"
                class="w-full py-4 rounded-full bg-meadow text-white font-display font-semibold text-lg shadow-lg hover:bg-meadow-dark transition disabled:opacity-60">
            <span wire:loading.remove>Kirim Custom Request</span>
            <span wire:loading>Mengirim...</span>
        </button>
    </form>
</div>