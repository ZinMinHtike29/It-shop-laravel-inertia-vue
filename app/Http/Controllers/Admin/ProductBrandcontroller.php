<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\ProductBrand;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ProductBrandcontroller extends Controller
{
    //Direct Brand PAge
    public function brandPage()
    {
        $brand = ProductBrand::when(request("key"), function ($query) {
            $query->where("title", "like", "%" . request("key") . "%");
        })->orderBy("id", "desc")->paginate(5);
        $brand->through(function ($value) {
            $productCount = Product::where("brand_id", $value->id)->get()->count();
            $value["product_count"] = $productCount;
            return $value;
        });
        return Inertia::render("Admin/ProductBrand", [
            "brands" => $brand
        ]);
    }

    //create Brand
    public function createBrand(Request $request)
    {
        Validator::make($request->all(), [
            "title" => "required"
        ])->validate();
        ProductBrand::create($request->all());
        return redirect()->route('admin#brandPage');
    }

    //Update Brand
    public function updateBrand(Request $request)
    {
        ProductBrand::where("id", $request->id)->update([
            "title" => $request->title,
        ]);
        return response()->json(["success" => true], 200);
    }

    //Delete Brand
    public function deleteBrand(Request $request)
    {
        ProductBrand::where('id', $request->id)->delete();
        return response()->json(["success" => true], 200);
    }
}