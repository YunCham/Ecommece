<?php

namespace App\Http\Livewire\Admin;

use App\Models\HomeSlider;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;

class AdminEditHomeSliderComponent extends Component
{
    use WithFileUploads;
    public $slide_id;
    public $top_title;
    public $title;
    public $sub_title;
    public $offer;
    public $link;
    public $image;
    public $status;
    public $newimage;

    public function mount($slide_id)
    {
        $slide = HomeSlider::find($slide_id);
        $this->slide_id = $slide->id;
        $this->top_title = $slide->top_title;
        $this->top_title = $slide->top_title;
        $this->title = $slide->title;
        $this->sub_title = $slide->sub_title;
        $this->offer = $slide->offer;
        $this->link = $slide->link;
        $this->image = $slide->image;
        $this->status = $slide->status;
    }

    public function updateSlider()
    {
        $this->validate([

            'top_title' => 'required',
            'title' => 'required',
            'sub_title' => 'required',
            'offer' => 'required',
            'link' => 'required',
            'status' => 'required'
        ]);

        $slide =  HomeSlider::find($this->slide_id);
        $slide->top_title = $this->top_title;
        $slide->title = $this->title;
        $slide->sub_title = $this->sub_title;
        $slide->offer = $this->offer;
        $slide->link = $this->link;
        if ($this->newimage) {
            unlink('assets/imgs/slider/' . $slide->image);
            $imageName = Carbon::now()->timestamp . '.' . $this->newimage->extension();
            $this->newimage->storeAs('slider', $imageName);
            $slide->image  = $imageName;
        }
        $slide->status = $this->status;
        $slide->save();
        session()->flash('message', 'Nueva Slider registrado');
    }

    public function render()
    {
        return view('livewire.admin.admin-edit-home-slider-component');
    }
}
