<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    //Direct Profile Page
    public function profilePage()
    {
        return Inertia::render("Admin/ProfilePage");
    }

    //Update Profile
    public function updateProfile(Request $request)
    {
        $this->validateUserUpdateData($request);
        $data = $this->getUpdateData(($request));
        if ($request->hasFile("profile")) {
            $dbImage = User::select("profile")->where("id", Auth::user()->id)->first();
            if ($dbImage != null) {
                Storage::delete("public/$dbImage->profile");
            }
            $imgName = uniqid() . $request->file("profile")->getClientOriginalName();
            $request->file("profile")->storeAs("public", $imgName);
            $data["profile"] = $imgName;
        }
        $data = User::where('id', Auth::user()->id)->update($data);
        return back()->with(["success" => "Profile Update Success"]);
    }

    //Change Admin Acc PAssword
    public function changePassword(Request $request)
    {
        $this->validateChangePasswordData($request);
        $db_password = User::where("id", Auth::user()->id)->first();
        $db_password = $db_password->password;
        if (Hash::check($request->oldPassword, $db_password)) {
            User::where("id", Auth::user()->id)->update([
                "password" => Hash::make($request->newPassword)
            ]);
            return back()->with(["success" => "Password Change Success"]);
        } else {
            return back()->with(["error" => "The Old Password Not Match. Try Again ..."]);
        }
    }

    //Validate Change PAssword Data
    private function validateChangePasswordData($request)
    {
        Validator::make($request->all(), [
            "oldPassword" => "required",
            "newPassword" => "required||min:6",
            "confirmPassword" => "required||min:6||same:newPassword"
        ])->validate();
    }

    //Validate User Update Data
    private function validateUserUpdateData($request)
    {
        Validator::make($request->all(), [
            "name" => "required",
            "email" => "required",
            "address" => "required",
            "phone" => "required"
        ])->validate();
    }

    //Get User Update Data
    private function getUpdateData($request)
    {
        return
            [
                "name" => $request->name,
                "email" => $request->email,
                "address" => $request->address,
                "phone" => $request->phone
            ];
    }
}