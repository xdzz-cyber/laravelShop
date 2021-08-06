<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\HomeCategory;
use App\Models\HomeSlider;
use App\Models\Product;
use App\Models\Sale;
use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        $sliders = HomeSlider::where("status",1)->get();
        $latest_products = Product::orderBy("created_at","DESC")->get()->take(8);
        $category = HomeCategory::find(1);
        $cats = explode(",",$category->selectedCategories);
        $categories = Category::whereIn("id",$cats)->get();
        $numberOfProducts = $category->numberOfProducts;
        $productsOnSale = Product::where("sale_price",">",0)->inRandomOrder()->get()->take(8);
        $saleTimeRecord = Sale::find(1);
        return view('livewire.home-component', ["sliders"=>$sliders,"latest_products"=>$latest_products, "categories"=>$categories, "numberOfProducts"=>$numberOfProducts, "productsOnSale"=>$productsOnSale, "saleTimeRecord"=>$saleTimeRecord])->layout("layouts.base");
    }
}
