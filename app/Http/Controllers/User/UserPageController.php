<?php

namespace App\Http\Controllers\User;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\Category;
use App\Models\SaveProduct;
use App\Models\ProductBrand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserPageController extends Controller
{
    //Direct User Home page
    public function homePage()
    {
        $category = Category::get();
        $brand = ProductBrand::get();
        $saveProductCount = SaveProduct::where("user_id", Auth::user()->id)->get()->count();
        $product = Product::with("category", "brand", "images")
            ->when(request('searchKey'), function ($query) {
                $query->where("product_name", "like", '%' . request('searchKey') . '%')->orWhere("description", "like", '%' . request('searchKey') . '%');
            })
            ->when(request('filterCategory'), function ($query) {
                $query->where("category_id", request('filterCategory'));
            })
            ->when(request('filterBrand'), function ($query) {
                $query->where("brand_id", request('filterBrand'));
            })
            ->orderBy("id", "desc")
            ->paginate(9);

        $product->through(function ($value) {
            $checkIsSave = SaveProduct::where("user_id", Auth::user()->id)->where("product_id", $value->id)->get();

            if (!$checkIsSave->isEmpty()) {
                $value->is_save = true;
                return $value;
            } else {
                $value->is_save = false;
                return $value;
            }
        });

        return Inertia::render("User/Home", [
            "category" => $category,
            "brand" => $brand,
            "saveProductCount" => $saveProductCount,
            'product' => $product
        ]);
    }
}
