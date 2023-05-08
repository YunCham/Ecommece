<?php

namespace App\Http\Livewire;

use Livewire\Component;

class HeaderSearchComponent extends Component
{
    public $q;

    //inicamos la intancia del component de valores
    public function mount()
    {
        $this->fill(request()->only('q'));
    }
    public function render()
    {
        return view('livewire.header-search-component');
    }
}
