<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class CategoryController extends Controller
{
    //Direct Category PAge
    public function categoryPage()
    {
        $category = Category::when(request("key"), function ($query) {
            $query->where("title", "like", "%" . request("key") . "%");
        })->orderBy("id", "desc")->paginate(3);
        $category->through(function ($value) {
            $productCount = Product::where("category_id", $value->id)->get()->count();
            $value["product_count"] = $productCount;
            return $value;
        });
        return Inertia::render("Admin/CategoryPage", [
            "categories" => $category
        ]);
    }

    //Category Create
    public function createCategory(Request $request)
    {
        Validator::make($request->all(), [
            "title" => "required"
        ])->validate();
        Category::create($request->all());
        return redirect()->route("admin#categoryPage");
    }

    //Update Category
    public function updateCategory(Request $request)
    {
        Category::where("id", $request->id)->update([
            "title" => $request->title,
        ]);
        return response()->json(["success" => true], 200);
    }

    //Delete Category
    public function deleteCategory(Request $request)
    {
        Category::where('id', $request->id)->delete();
        return response()->json(["success" => true], 200);
    }
}