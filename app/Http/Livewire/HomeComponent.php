<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\HomeSlider;
use App\Models\Product;
use Livewire\Component;
use Cart;

class HomeComponent extends Component
{
    public function store($product_id, $product_name, $product_price)
    {
        Cart::instance('cart')->add($product_id, $product_name, 1, $product_price)->associate('\App\Models\Product');
        session()->flash('success_massege', 'Item added in Cart');
        $this->emitTo('cart-icon-component', 'refreshComponent');
        return redirect()->route('shop.cart');
    }
    public function render()
    {
        $slider=HomeSlider::where('status',1)->get();
        $lproducts=Product::orderBy('created_at','DESC')->get();
        $fproducts=Product::where('factured',1)->inRandomOrder()->get()->take(8);
        $pcategories=Category::where('is_popular',1)->inRandomOrder()->get()->take(8);
        return view('livewire.home-component',['slider'=>$slider,'lproducts'=>$lproducts,'fproducts'=>$fproducts,'pcategories'=>$pcategories]);
    }
}
