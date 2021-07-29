<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCategoryComponent extends Component
{
    use WithPagination;

    public function render()
    {
        $categories = Category::Paginate(5);
        return view('livewire.admin.admin-category-component', ['categories'=>$categories])->layout("layouts.base");
    }
}
