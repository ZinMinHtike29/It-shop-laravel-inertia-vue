<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;

class ContactController extends Controller
{
    //Direct Contact List PAge
    public function contactListPage()
    {
        $contacts = Contact::orderBy("created_at", "desc")->paginate(10);
        return Inertia::render("Admin/ContactLists", [
            "contacts" => $contacts
        ]);
    }
}