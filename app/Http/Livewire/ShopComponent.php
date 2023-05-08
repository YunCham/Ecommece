<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;
use PhpParser\Node\Stmt\Foreach_;

class ShopComponent extends Component
{
    use WithPagination;
    public $pageSize = 12;
    public $orderBy = "Default Sorting";

    public $min_value = 0;
    public $max_value = 1000;

    public function store($product_id, $product_name, $product_price)
    {
        Cart::instance('cart')->add($product_id, $product_name, 1, $product_price)->associate('\App\Models\Product');
        session()->flash('success_massege', 'Item added in Cart');
        $this->emitTo('cart-icon-component', 'refreshComponent');
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

    //funcion para megusa producto
    public function addToWishlist($product_id, $product_name, $product_price)
    {
        Cart::instance('wishlist')->add($product_id, $product_name, 1, $product_price)->associate('\App\Models\Product');
        $this->emitTo('wishlist-icon-component', 'refreshComponent');
    }

    //Implementacion de la funcion de quitar me gusta
    public function removeFromWishlist($product_id)
    {
        foreach (Cart::instance('wishlist')->content() as $witem) {
            if ($witem->id == $product_id) {
                Cart::instance('wishlist')->remove($witem->rowId);
                $this->emitTo('wishlist-icon-component', 'refreshComponent');
                return;
            }
        }
    }

    public function render()
    {
        /*
        if ($this->orderBy =='Price: Low to High')
        {
            $products = Product::orderBy('regular_price','ASC')->paginate($this->pageSize);
        }else if($this->orderBy =='Price: High to Low')
        {
            $products = Product::orderBy('regular_price','DESC')->paginate($this->pageSize);
        } else if($this->orderBy =='Sort By Newness')
        {
            $products = Product::orderBy('created_at','DESC')->paginate($this->pageSize);
        }else{
            $products = Product::paginate($this->pageSize); // paginacion de product
        }*/

        switch ($this->orderBy) {
            case 'Price: Low to High':
                $products = Product::whereBetween('regular_price', [$this->min_value, $this->max_value])->orderBy('regular_price', 'ASC')->paginate($this->pageSize);
                break;
            case 'Price: High to Low':
                $products = Product::whereBetween('regular_price', [$this->min_value, $this->max_value])->orderBy('regular_price', 'DESC')->paginate($this->pageSize);
                break;
            case 'Sort By Newness':
                $products = Product::whereBetween('regular_price', [$this->min_value, $this->max_value])->orderBy('created_at', 'DESC')->paginate($this->pageSize);
                break;
            default:
                $products = Product::whereBetween('regular_price', [$this->min_value, $this->max_value])->paginate($this->pageSize);
                //break;
        }
        $categories = Category::orderBy('name', 'ASC')->get();
        // nos devuelve la vista de livewire productos
        return view('livewire.shop-component', ['products' => $products, 'categories' => $categories]);
    }
}
