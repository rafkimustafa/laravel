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
    public $sortBy = 'id';
    public $sortAsc = true;
    public $product;

    public $confirmingProductDeletion = false;
    public $confirmingProductAdd = false;

    protected $queryString = [
        'active' => ['except' => false],
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'id'],
        'sortAsc' => ['except' => true],
    ];

    protected $rules = [
        'product.name' => 'required|string|min:4',
        'product.price' => 'required|numeric|between:1,100',
        'product.status' => 'boolean'
    ];

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
            })
            ->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC');


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
    public function updating()
    {
        $this->resetPage();
    }
    public function sortBy($field)
    {
        if ($field == $this->sortBy) {
            $this->sortAsc = !$this->sortAsc;
        }
        $this->sortBy = $field;
    }
    public function confirmProductDeletion($id)
    {
        // $product->delete();
        $this->confirmingProductDeletion = $id;
    }

    public function deleteProduct(Product $product)
    {
        $product->delete();
        $this->confirmProductDeletion = false;
    }

    public function confirmProductAdd()
    {
        // $product->delete();
        $this->reset(['product']);
        $this->confirmingProductAdd = true;
    }

    public function saveProduct()
    {
        $this->validate();

        auth()->user()->product()->create([
            'name' => $this->product['name'],
            'price' => $this->product['price'],
            'status' => $this->product['status'] ?? 0
        ]);
    }
}
