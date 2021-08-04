<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\HomeCategory;
use Livewire\Component;

class AdminHomeCategoryComponent extends Component
{
    public $selectedCategories = [];
    public $numberOfProducts;

    public function mount(){
        $category = HomeCategory::find(1);
        $this->selectedCategories = explode(",",$category->selectedCategories);
        $this->numberOfProducts = $category->numberOfProducts;
    }

    public function updateHomeCategory(){
        $category = HomeCategory::find(1);
        $category->selectedCategories = implode(",", $this->selectedCategories);
        $category->numberOfProducts = $this->numberOfProducts;
        $category->save();
        session()->flash("success_message", "Home category has been successfully updated");
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.admin-home-category-component', ["categories"=>$categories])->layout("layouts.base");
    }
}
