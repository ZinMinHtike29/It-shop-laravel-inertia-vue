<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //Direct User Controller
    public function userListPage()
    {
        $user = User::when(request("key"), function ($query) {
            $query->where('name', "like", "%" . request("key") . "%")
                ->orWhere("email", "like", "%" . request("key") . "%");
        })->where('role', "user")->orderBy("id", "desc")->paginate("6");
        return Inertia::render("Admin/UserList", [
            "users" => $user
        ]);
    }

    //User Change Role
    public function userChangeRole(Request $request)
    {
        User::where("id", $request->id)->update([
            "role" => "admin"
        ]);
        return response()->json(["success" => true], 200);
    }

    //Delete User
    public function deleteUser(Request $request)
    {
        User::where("id", $request->id)->delete();
        return response()->json(["success" => true], 200);
    }
}