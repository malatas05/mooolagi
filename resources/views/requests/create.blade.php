@extends('layouts.public')

@section('title', 'Custom Request: ' . $product->name . ' - Mooolagi')

@section('content')
    @livewire('custom-request-form', ['product' => $product])
@endsection