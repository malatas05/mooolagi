<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ProductCatalog extends Component
{
    use WithPagination;

    #[Url(as: 'kategori')]
    public string $categorySlug = '';

    #[Url(as: 'cari')]
    public string $search = '';

    public function updatedCategorySlug(): void
    {
        $this->resetPage();
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $categories = Category::withCount('products')->get();

        $products = Product::query()
            ->where('is_active', true)
            ->when($this->categorySlug, function ($query) {
                $query->whereHas('category', fn ($q) => $q->where('slug', $this->categorySlug));
            })
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->with(['category', 'images' => fn ($q) => $q->where('is_cover', true)])
            ->latest()
            ->paginate(12);

        return view('livewire.product-catalog', compact('categories', 'products'));
    }
}