<?php

namespace App\Http\Controllers\User;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\SaveProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Rating;
use App\Models\VisitCount;
use Illuminate\Support\Facades\Auth;

class ActionController extends Controller
{
    //Save Product
    public function saveProduct(Request $request)
    {
        $data = [
            "user_id" => Auth::user()->id,
            "product_id" => $request->productId
        ];
        SaveProduct::create($data);
        return response()->json(["success" => true], 200);
    }

    //Save Product Lists PAge
    public function saveProductLists()
    {
        $product = SaveProduct::where("user_id", Auth::user()->id)->with("product", "product.images", "product.category", "product.brand", "product.specifications")->orderBy("id", "desc")->paginate(12);
        return Inertia::render("User/SaveProduct", [
            'product' => $product
        ]);
    }

    //Remove Save Product
    public function removeSaveProduct(Request $request)
    {
        SaveProduct::where("id", $request->id)->delete();
        return response()->json(["success" => true], 200);
    }

    //Add Rating
    public function addRating(Request $request)
    {
        $data = [
            "user_id" => Auth::user()->id,
            "product_id" => $request->productId,
            "rating" => $request->ratingValue
        ];
        $newRating = Rating::create($data);
        return response()->json(["rating" => $newRating, "success" => true], 200);
    }

    //Remove Rating
    public function removeRating(Request $request)
    {
        Rating::where("id", $request->ratingId)->delete();
        return response()->json(["success" => true], 200);
    }

    //Add Comment
    public function addComment(Request $request)
    {
        $data = [
            "user_id" => Auth::user()->id,
            "product_id" => $request->productId,
            "comment" => $request->comment
        ];
        $newComment = Comment::create($data);
        $newComment = Comment::where("id", $newComment->id)->with("user")->first();
        return back();
    }

    //Remove Comment
    public function removeComment(Request $request)
    {
        Comment::where("id", $request->commentId)->delete();
        return response()->json(["success" => true], 200);
    }

    //Direct Contact PAge
    public function contactPage()
    {
        return Inertia::render("User/ContactPage");
    }

    //Send Message
    public function sendMessage(Request $request)
    {
        $data = [
            "name" => $request->userName,
            "email" => $request->email,
            "message" => $request->message
        ];
        Contact::create($data);
        return redirect()->route("user#contactPage");
    }

    //Visit Count
    public function visitCount()
    {
        VisitCount::create(["user_id" => Auth::user()->id]);
    }
}