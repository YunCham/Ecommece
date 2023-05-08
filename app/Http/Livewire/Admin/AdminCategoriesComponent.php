<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;


class AdminCategoriesComponent extends Component
{
    use WithPagination;

    public $category_id;

public function deleteCategory()
{
    $category = Category::find($this->category_id);
    unlink('assets/imgs/categories/' . $category->image);
    $category->delete();
    session()->flash('message','Categoria elimidado exitosamente!');
}

    public function render()
    {
        $categories = Category::orderBy('name', 'ASC')->paginate(5);
        return view('livewire.admin.admin-categories-component', ['categories' => $categories]);
    }
}
