<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;

class SearchComponent extends Component
{
    use WithPagination;
    public $pageSize=12;
    public $orderBy="Default Sorting";

    public $q;
    public $search_term;

    public function mount()
    {
        $this->fill(request()->only('q'));
        $this->search_term='%'.$this->q. '%';

    }

    public function store($product_id, $product_name, $product_price)
    {
        Cart::instance('cart')->add($product_id,$product_name,1,$product_price)->associate('\App\Models\Product');
        session()->flash('success_massege','Item added in Cart');
        $this->emitTo('cart-icon-component','refreshComponent');
        return redirect()->route('shop.cart');
    }

    // funcion para ver  cantidqad de productos en  pantalla
    public function changePageSize($size)
    {
        $this->pageSize = $size;
    }

    //funcion pra ordenar segun precio
    public function changeOrderBy($order)
    {
        $this->orderBy = $order;
    }

    public function render()
    {
        switch ($this->orderBy) {
            case 'Price: Low to High':
                $products = Product::where('name','like',$this->search_term)->orderBy('regular_price', 'ASC')->paginate($this->pageSize);
                break;
            case 'Price: High to Low':
                $products = Product::where('name','like',$this->search_term)->orderBy('regular_price', 'DESC')->paginate($this->pageSize);
                break;
            case 'Sort By Newness':
                $products = Product::where('name','like',$this->search_term)->orderBy('created_at', 'DESC')->paginate($this->pageSize);
                break;
            default:
                $products = Product::where('name','like',$this->search_term)->paginate($this->pageSize);
                //break;
        }
        $categories = Category::orderBy('name','ASC')->get();
        // nos devuelve la vista de livewire productos
        return view('livewire.search-component',['products' => $products,'categories' => $categories]);
    }
}
