<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Portfolio;
use App\Models\Product;
use Illuminate\Support\Collection;

class SitemapController extends Controller
{
    public function index()
    {
        $urls = new Collection();

        $urls->push(['loc' => route('home'), 'priority' => '1.0']);
        $urls->push(['loc' => route('catalog'), 'priority' => '0.9']);
        $urls->push(['loc' => route('portfolio.index'), 'priority' => '0.7']);
        $urls->push(['loc' => route('testimonial.index'), 'priority' => '0.5']);
        $urls->push(['loc' => route('blog.index'), 'priority' => '0.7']);

        Product::where('is_active', true)->get()->each(function ($product) use ($urls) {
            $urls->push([
                'loc' => route('products.show', $product),
                'lastmod' => $product->updated_at->toAtomString(),
                'priority' => '0.8',
            ]);
        });

        Portfolio::all()->each(function ($portfolio) use ($urls) {
            $urls->push([
                'loc' => route('portfolio.show', $portfolio),
                'lastmod' => $portfolio->updated_at->toAtomString(),
                'priority' => '0.6',
            ]);
        });

        Article::where('is_published', true)->get()->each(function ($article) use ($urls) {
            $urls->push([
                'loc' => route('blog.show', $article),
                'lastmod' => $article->updated_at->toAtomString(),
                'priority' => '0.6',
            ]);
        });

        return response()
            ->view('sitemap', compact('urls'))
            ->header('Content-Type', 'text/xml');
    }
}