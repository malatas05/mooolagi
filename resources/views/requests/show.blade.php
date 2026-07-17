@extends('layouts.public')

@section('title', 'Detail Request - Mooolagi')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 py-12">

    <a href="{{ route('dashboard') }}" class="text-sm font-body text-cocoa-dark/60 hover:text-meadow transition">&larr; Kembali ke Dashboard</a>

    <div class="flex items-center justify-between gap-4 mt-4 mb-8">
        <h1 class="font-display text-2xl font-bold text-meadow-dark">{{ $customRequest->product->name }}</h1>
        <span class="text-xs font-display font-semibold px-3 py-1.5 rounded-full whitespace-nowrap {{ $customRequest->status_badge_class }}">
            {{ $customRequest->status_label }}
        </span>
    </div>

    <div class="bg-white rounded-2xl border-2 border-sky-light p-6 space-y-4 mb-6">
        <h2 class="font-display font-semibold text-cocoa-dark">Bukti Transfer</h2>
        @if ($customRequest->payment_proof)
            <img src="{{ asset('storage/' . $customRequest->payment_proof) }}" class="w-40 h-40 object-cover rounded-xl border-2 border-sky-light">
        @endif

        <div class="text-sm font-body">
            <p class="text-cocoa-dark/50">Tanggal Diajukan</p>
            <p class="text-cocoa-dark font-medium">{{ $customRequest->created_at->translatedFormat('d F Y') }}</p>
        </div>

        @if ($customRequest->customer_notes)
            <div>
                <p class="text-cocoa-dark/50 text-sm font-body">Catatan</p>
                <p class="text-cocoa-dark text-sm font-body">{{ $customRequest->customer_notes }}</p>
            </div>
        @endif
    </div>

    @if ($customRequest->product->request_type === 'simple')
        <div class="bg-white rounded-2xl border-2 border-sky-light p-6 space-y-3">
            <h2 class="font-display font-semibold text-cocoa-dark">Detail Pesanan</h2>
            <div class="text-sm font-body">
                <p class="text-cocoa-dark/50">Jumlah</p>
                <p class="text-cocoa-dark font-medium">{{ $customRequest->quantity ?? '-' }}</p>
            </div>
        </div>
    @else
        @foreach ($customRequest->slotValues->groupBy('slot.section.name') as $sectionName => $values)
            <div class="bg-white rounded-2xl border-2 border-bubblegum p-6 space-y-4 mb-4">
                <h2 class="font-display font-semibold text-bubblegum">{{ $sectionName }}</h2>
                @foreach ($values as $value)
                    <div class="border-t border-sky-light pt-3">
                        <p class="text-xs font-display font-semibold text-cocoa-dark/70">{{ $value->slot->label }}</p>
                        @if ($value->value_text)
                            <p class="text-sm font-body text-cocoa-dark mt-1">{{ $value->value_text }}</p>
                        @elseif ($value->value_file_path)
                            <img src="{{ asset('storage/' . $value->value_file_path) }}" class="w-24 h-24 object-cover rounded-lg border-2 border-sky-light mt-1">
                        @endif
                    </div>
                @endforeach
            </div>
        @endforeach
    @endif
</div>
@endsection