<?php

namespace App\Http\Controllers\User;

use Inertia\Inertia;
use App\Models\Rating;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class UserProductController extends Controller
{
    //Direct Product Details And Add To Cart Page
    public function detailsAndAddtoCartPage($id)
    {
        $product = Product::where("id", $id)->with("images", "colors", "specifications", "brand", "category")->first();

        //Get Rating
        $ratings = Rating::where("product_id", $id)->with("user")->orderBy("created_at", "desc")->get();

        //Check IsRating
        $checkIsRating = Rating::where("user_id", Auth::user()->id)->where("product_id", $id)->first();
        if (!empty($checkIsRating)) {
            $product->is_rating = true;
            $product->currentUserRating = $checkIsRating;
            $ratings = $ratings->filter(function ($value) {
                if ($value->user->id != Auth::user()->id) {
                    return   $value;
                }
            });
        } else {
            $product->is_rating = false;
            $product->currentUserRating = null;
        }

        //Get Comment
        $comments =  Comment::where("product_id", $id)->with("user")->orderBy("created_at", "desc")->get();
        return Inertia::render('User/ProductDetailsAndCart', [
            "product" => $product,
            "ratings" => $ratings,
            "comments" => $comments
        ]);
    }

    //Direct Cart PAge
    public function cartPage()
    {
        return Inertia::render('User/CartPage');
    }
}