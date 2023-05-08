<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\HomeSlider;
use Livewire\WithPagination;

class AdminHomeSliderComponent extends Component
{
    use WithPagination;
    public $slide_id;

    public function deleteSlade()
    {
        $slide = HomeSlider::find($this->slide_id);
        unlink('assets/imgs/slider/'.$slide->image);
        $slide->delete();
        session()->flash('message','Sliders elimidado exitosamente!');

    }
    public function render()
    {
        $slider=HomeSlider::orderBy('created_at','DESC')->get();
        return view('livewire.admin.admin-home-slider-component',['slider'=>$slider]);
    }
}
