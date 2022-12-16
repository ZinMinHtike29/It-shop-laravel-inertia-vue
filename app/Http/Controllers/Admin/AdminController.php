<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\OrderLists;
use App\Models\Product;
use App\Models\User;
use App\Models\VisitCount;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    //Direct Admin Home PAge
    public function adminHomePage()
    {
        $newProduct = Product::whereBetween("created_at", [now()->subDay(7), now()])->get()->count();
        $newComment = Comment::whereBetween("created_at", [now()->subDay(7), now()])->get()->count();
        $newComment = Comment::whereBetween("created_at", [now()->subDay(7), now()])->get()->count();
        $newUser = User::whereBetween("created_at", [now()->subDay(7), now()])->get()->count();
        $totalProduct = Product::get()->count();
        $totalComments = Comment::get()->count();
        $orderList = OrderLists::get();
        $totalSale = 0;
        foreach ($orderList as $o) {
            $totalSale += $o->total_price;
        }
        $totalVisit = VisitCount::whereBetween("created_at", [now()->subDay(30), now()])->get()->count();
        return Inertia::render("Admin/HomePage", [
            "newProduct" => $newProduct,
            "newComment" => $newComment,
            "newUser" => $newUser,
            "totalProduct" => $totalProduct,
            "totalComments" => $totalComments,
            "totalSale" => $totalSale,
            "totalVisit" => $totalVisit
        ]);
    }

    //Direct Admin List Page
    public function adminListPage()
    {
        $admin = User::when(request("key"), function ($query) {
            $query->where('name', "like", "%" . request("key") . "%")
                ->orWhere("email", "like", "%" . request("key") . "%");
        })->where('role', "admin")->orderBy("id", "desc")->get();
        return Inertia::render("Admin/AdminList", [
            "admins" => $admin
        ]);
    }

    //ADmin Acc Remove
    public function removeAdmin(Request $request)
    {
        User::where("id", $request->id)->update([
            "role" => "user"
        ]);
        return response()->json(["success" => true], 200);
    }
}