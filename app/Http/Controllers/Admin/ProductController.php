<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductBrand;
use App\Models\ProductColor;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ProductSpecification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //Direct Create Product Page
    public function createProductPage()
    {
        $category = Category::get();
        $brand = ProductBrand::get();
        return Inertia::render("Admin/CreateProduct", [
            "category" => $category,
            "brand" => $brand
        ]);
    }

    //Create Product
    public function createProduct(Request $request)
    {
        $this->validationProductData($request, "create");
        $data = $this->getProductData($request);
        $storeData = Product::create($data);

        foreach ($request->productColors as $color) {
            if ($color["color"] != null) {
                ProductColor::create([
                    "product_id" => $storeData->id,
                    "color" => $color["color"]
                ]);
            }
        }

        foreach ($request->image as $image) {
            $imgName = uniqid() . $image->getClientOriginalName();
            $image->storeAs("public", $imgName);
            ProductImage::create([
                "product_id" => $storeData->id,
                'image' => $imgName
            ]);
        }


        foreach ($request->productSpecs as $productSpec) {
            ProductSpecification::create([
                "product_id" => $storeData->id,
                "specification" => $productSpec["specification"],
                "price" => $productSpec["price"]
            ]);
        }

        return redirect()->route("admin#productList");
    }

    //Product List Page
    public function productList()
    {
        $products = Product::with("images", "colors", "specifications", "category", "brand")->orderBy("id", "desc")->paginate(5);
        return Inertia::render("Admin/ProductList", [
            "products" => $products
        ]);
    }

    //Delete Product
    public function deleteProduct(Request $request)
    {
        $images = Product::with("images")->where("id", $request->id)->first();
        $images = $images->images;
        foreach ($images as $image) {
            Storage::delete("public/$image->image");
        }
        ProductImage::where("product_id", $request->id)->delete();
        ProductColor::where("product_id", $request->id)->delete();
        ProductSpecification::where("product_id", $request->id)->delete();
        Product::where("id", $request->id)->delete();
        return response()->json(["success" => true], 200);
    }

    //direct productDetailsAndUpdatePage
    public function productDetailsAndUpdatePage($id)
    {
        $product = Product::where("id", $id)->with("images", "colors", "specifications", 'category', 'brand', 'comments.user')->first();
        $category = Category::get();
        $brand = ProductBrand::get();

        $rating = DB::table("ratings")
            ->select("ratings.*", DB::raw("count(rating) as rating_count"))
            ->groupBy("rating")
            ->having("product_id", $product->id)
            ->get();
        $product->ratings = $rating;
        return Inertia::render("Admin/productDetailsAndUpdate", [
            "product" => $product,
            'category' => $category,
            'brand' => $brand
        ]);
    }

    //Update Product Image
    public function updateImage(Request $request)
    {
        Storage::delete("public/$request->oldImage");
        $newImageName = uniqid() . $request->file('updateFile')->getClientOriginalName();
        $request->file('updateFile')->storeAs('public', $newImageName);
        ProductImage::where("id", $request->imageId)->where("product_id", $request->productId)->update([
            "image" => $newImageName
        ]);
        return response()->json(["newImage" => $newImageName, "success" => "true"], 200);
    }

    //Update Product
    public function updateProduct(Request $request)
    {
        // $this->validationProductData($request, "update");
        $data = $this->getProductData($request);
        Product::where("id", $request->productId)->update($data);
        // Set New color Or Update Color
        foreach ($request->productColors as $color) {
            if ($color["color"] != null) {
                if (isset($color["id"])) {
                    ProductColor::where("id", $color["id"])->update([
                        "color" => $color["color"]
                    ]);
                } else {
                    ProductColor::create([
                        "product_id" => $request->productId,
                        "color" => $color["color"]
                    ]);
                }
            }
        }

        //Update Product Spec Or Add New
        foreach ($request->productSpecs as $productSpec) {
            if (isset($productSpec["id"])) {
                ProductSpecification::where("id", $productSpec["id"])->update([
                    "price" =>  $productSpec["price"],
                    "specification" => $productSpec['specification']
                ]);
            } else {
                ProductSpecification::create([
                    "product_id" => $request->productId,
                    "specification" => $productSpec["specification"],
                    "price" => $productSpec["price"]
                ]);
            }
        }
        return back()->with(["success" => "Product Update Success"]);
    }

    //delete Color
    public function deleteColor(Request $request)
    {
        ProductColor::where("id", $request->id)->delete();
        return response()->json(["success" => "true"], 200);
    }

    //Delete Spec
    public function deleteSpec(Request $request)
    {
        ProductSpecification::where("id", $request->id)->delete();
        return response()->json(["success" => "true"], 200);
    }

    //Validation Product Data
    private function validationProductData($request, $status)
    {
        $data = [
            "productName" => "required",
            "description" => "required",
            "categoryId" => "required",
            "brandId" => "required",
            "productSpecs.*.price" => "required",
            "productSpecs.*.specification" => "required",
        ];
        if ($status == "create") {
            $data["image"] = "required";
            $data['image.*'] = 'required';
        }
        Validator::make($request->all(), $data, [
            "productSpecs.*.price.required"  => "Price For Product is Required",
            "productSpecs.*.specification.required"  => "Specification For Product is Required"
        ])->validate();
    }

    //Get Product Data
    private function getProductData($request)
    {
        return [
            "product_name" => $request->productName,
            "description" => $request->description,
            "category_id" => $request->categoryId,
            "brand_id" => $request->brandId
        ];
    }
}