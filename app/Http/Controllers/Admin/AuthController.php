<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //Direct Register Page
    public function registerPage()
    {
        return Inertia::render("Auth/Register");
    }

    //Direct Login Paage
    public function loginPage()
    {
        return Inertia::render("Auth/Login");
    }

    //Part User And Admin
    public function partUserAndAdmin()
    {
        if (Auth::user()->role == "user") {
            return redirect()->route('user#home');
        } else {
            return redirect()->route("admin#homePage");
        }
    }
}