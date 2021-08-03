<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class AdminProductComponent extends Component
{
    use WithPagination;

    public function deleteProduct($id){
        $productToBeDeleted = Product::find($id);
        $productToBeDeleted->delete();
        session()->flash("success_message","Product has been successfully deleted");
    }

    public function render()
    {
        $products = Product::paginate(5);
        return view('livewire.admin.admin-product-component', ["products"=>$products])->layout("layouts.base");
    }
}
