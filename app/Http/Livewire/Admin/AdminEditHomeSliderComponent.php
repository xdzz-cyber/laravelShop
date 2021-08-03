<?php

namespace App\Http\Livewire\Admin;

use App\Models\HomeSlider;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminEditHomeSliderComponent extends Component
{

    use WithFileUploads;

    public $title;
    public $subtitle;
    public $price;
    public $link;
    public $image;
    public $status;
    public $newImage;
    public $slider_id;

    public function mount($slide_id)
    {
        $slider = HomeSlider::find($slide_id);
        $this->title = $slider->title;
        $this->subtitle = $slider->subtitle;
        $this->price = $slider->price;
        $this->link = $slider->link;
        //$imageName = Carbon::now()->timestamp . ".{$this->image->extension()}"$this->image->stores("sliders", $imageName);
        $this->image = $slider->image;
        $this->status = $slider->status;
        $this->slider_id = $slider->id;
    }

    public function updateSlide(){
        $slider = HomeSlider::find($this->slider_id);
        $slider->title = $this->title;
        $slider->subtitle = $this->subtitle;
        $slider->price = $this->price;
        $slider->link = $this->link;
        if ($this->newImage){
            $imageName = Carbon::now()->timestamp . ".{$this->newImage->extension()}";
            $this->newImage->storeAs("sliders",$imageName);
            $slider->image = $imageName;
        }
        $slider->status = $this->status;

        $slider->save();
        session()->flash("success_message", "Successfully update slide");
    }

    public function render()
    {
        return view('livewire.admin.admin-edit-home-slider-component')->layout("layouts.base");
    }
}
