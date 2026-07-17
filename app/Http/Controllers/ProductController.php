<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        $product->load(['category', 'images' => fn ($q) => $q->orderBy('sort_order')]);
$productSchema = json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Product',
    'name' => $product->name,
    'description' => \Illuminate\Support\Str::limit(strip_tags($product->description), 300),
    'image' => $product->images->map(fn ($img) => asset('storage/' . $img->image_path))->values(),
    'category' => $product->category->name,
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        return view('products.show', compact('product', 'productSchema'));
    }
}