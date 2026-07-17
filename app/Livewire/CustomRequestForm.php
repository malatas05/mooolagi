<?php

namespace App\Livewire;

use App\Models\CustomRequest;
use App\Models\Product;
use App\Models\RequestSlotValue;
use Livewire\Component;
use Livewire\WithFileUploads;

class CustomRequestForm extends Component
{
    use WithFileUploads;

    public Product $product;

    // Field untuk produk 'simple'
    public $quantity = 1;
    public $delivery_email = '';
    // Field umum (dipakai kedua tipe produk)
    public $payment_proof;
    public $customer_notes = '';

    // Field untuk produk 'template'
    public array $slotTexts = [];
    public array $slotFiles = [];

    public function mount(Product $product): void
{
    $this->product = $product->load('templateSections.slots');
    $this->delivery_email = auth()->user()->email;
}

    protected function rules(): array
{
    $rules = [
        'delivery_email' => 'required|email',
        'payment_proof' => 'required|image|max:2048',
        'customer_notes' => 'nullable|string|max:1000',
    ];

        if ($this->product->request_type === 'simple') {
            $rules['quantity'] = 'required|integer|min:1';
        }

        return $rules;
    }

    public function render()
    {
        return view('livewire.custom-request-form');
    }

    public function submit()
    {
        $this->validate();

        $customRequest = CustomRequest::create([
            'user_id' => auth()->id(),
            'delivery_email' => $this->delivery_email,
            'product_id' => $this->product->id,
            'status' => 'pending',
            'quantity' => $this->product->request_type === 'simple' ? $this->quantity : null,
            'payment_proof' => \App\Services\ImageUploadService::storeResized($this->payment_proof, 'payment-proofs'),
            'customer_notes' => $this->customer_notes,
        ]);

        if ($this->product->request_type === 'template') {
            foreach ($this->product->templateSections as $section) {
                foreach ($section->slots as $slot) {
                    for ($i = 0; $i < $slot->quantity; $i++) {
                        $text = $this->slotTexts[$slot->id][$i] ?? null;
                        $file = $this->slotFiles[$slot->id][$i] ?? null;

                        if (blank($text) && ! $file) {
                            continue;
                        }

                        RequestSlotValue::create([
                            'custom_request_id' => $customRequest->id,
                            'template_slot_id' => $slot->id,
                            'instance_index' => $i,
                            'value_text' => $text,
                            'value_file_path' => $file ? \App\Services\ImageUploadService::storeResized($file, 'request-uploads') : null,
                        ]);
                    }
                }
            }
        }

        session()->flash('success', 'Request & bukti transfer kamu berhasil dikirim! Tim Mooolagi akan segera konfirmasi pesananmu.');

        return redirect()->route('dashboard');
    }
}