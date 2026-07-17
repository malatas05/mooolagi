<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->get();

        $featuredProducts = Product::where('is_active', true)
            ->with([
                'category',
                'images' => fn ($query) => $query->where('is_cover', true),
            ])
            ->latest()
            ->take(8)
            ->get();

        $testimonials = Testimonial::where('is_featured', true)
            ->latest()
            ->take(6)
            ->get();
$organizationSchema = json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Organization',
    'name' => 'Mooolagi',
    'description' => 'Creative Gift & Design Studio - Hampers, Gift Box, Custom Gift, Merchandise, Souvenir, Design Service, Packaging',
    'url' => url('/'),
    'logo' => asset('images/logo.png'),
    'address' => [
        '@type' => 'PostalAddress',
        'addressLocality' => 'Jakarta',
        'addressCountry' => 'ID',
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        return view('home', compact('categories', 'featuredProducts', 'testimonials', 'organizationSchema'));
    }
}