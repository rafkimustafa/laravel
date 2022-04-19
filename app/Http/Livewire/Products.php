<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;

    public $active;
    public $search;

    public function render()
    {
        //read table
        $products = Product::where('user_id', auth()->user()->id)
        //fitur search
            ->when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('price', 'like', '%' . $this->search . '%');
                });
            })

            ->when($this->active, function ($query) {
                return $query->active();
            });

        //search tabel
        $query = $products->toSql();
        //pagination tabel
        $products = $products->paginate(10);

        return view('livewire.products', [
            'products' => $products,
            'query' => $query
        ]);

        return view('livewire.products');
    }
    public function updatingActive()
    {
        $this->resetPage();
    }
}
