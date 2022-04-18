<?php

namespace App\Http\Livewire;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;

    public function render()
    {
        $products = Product::where('user_id', auth()->user()->id)
        ->paginate(10);
        return view('livewire.products',[
            'products' => $products
        ]);
        
        return view('livewire.products');
    }
}
