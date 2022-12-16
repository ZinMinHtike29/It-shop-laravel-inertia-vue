<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\OrderManageController;
use App\Http\Controllers\Admin\ProductBrandcontroller;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserActionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\User\ActionController;
use App\Http\Controllers\User\UserPageController;
use App\Http\Controllers\User\UserProductController;
use App\Http\Controllers\User\UserProfileController;
use Symfony\Component\HttpKernel\Profiler\Profile;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::get("/home", [AuthController::class, "partUserAndAdmin"])

Route::middleware("authMiddleWare")->group(function () {
    Route::redirect("/", "login");
    Route::get("/register", [AuthController::class, "registerPage"])->name("registerPage");
    Route::get("/login", [AuthController::class, "loginPage"])->name("loginPage");
});


Route::middleware([
    'auth'
])->group(function () {
    Route::get("/home", [AuthController::class, "partUserAndAdmin"]);
    //Admin
    Route::prefix("admin")->middleware("adminMiddleware")->group(function () {
        //Admin
        Route::get("/home", [AdminController::class, "adminHomePage"])->name("admin#homePage");
        Route::get("/list", [AdminController::class, "adminListPage"])->name("admin#listPage");
        Route::post("/remove/account", [AdminController::class, "removeAdmin"])->name("admin#removeAcc");

        //profile
        Route::get('/profile', [ProfileController::class, "profilePage"])->name("admin#profile");
        Route::post("/update/profile", [ProfileController::class, "updateProfile"])->name("admin#updateProfile");
        Route::post("change/password", [ProfileController::class, "changePassword"])->name("admin#changePassword");

        //Manage User
        Route::prefix("user")->group(function () {
            Route::get("/list", [UserController::class, "userListPage"])->name("admin#userList");
            Route::post("/changeRole", [UserController::class, "userChangeRole"])->name('admin#userChangeRole');
            Route::post("/delete", [UserController::class, "deleteUser"])->name("admin#deleteUser");
        });

        //Category
        Route::prefix("category")->group(function () {
            Route::get("list", [CategoryController::class, "categoryPage"])->name("admin#categoryPage");
            Route::post("create", [CategoryController::class, "createCategory"])->name("admin#createCategory");
            Route::post("update", [CategoryController::class, "updateCategory"])->name("admin#updateCategory");
            Route::post("delete", [CategoryController::class, "deleteCategory"])->name("admin#deleteCategory");
        });

        //Product Brand
        Route::prefix("brand")->group(function () {
            Route::get("list", [ProductBrandcontroller::class, "brandPage"])->name("admin#brandPage");
            Route::post('create', [ProductBrandcontroller::class, "createBrand"])->name("admin#createBrand");
            Route::post('update', [ProductBrandcontroller::class, "updateBrand"])->name('admin#updateBrand');
            Route::post("delete", [ProductBrandcontroller::class, "deleteBrand"])->name("admin#deleteBrand");
        });

        //Product
        Route::prefix("product")->group(function () {
            Route::get("createPage", [ProductController::class, "createProductPage"])->name("admin#createProductPage");
            Route::post('create', [ProductController::class, "createProduct"])->name("admin#createProduct");
            Route::get("list", [ProductController::class, "productList"])->name("admin#productList");
            Route::post("delete", [ProductController::class, "deleteProduct"])->name("admin#deleteProduct");
            Route::get("details/update/{id}", [ProductController::class, "productDetailsAndUpdatePage"])->name("admin#productDetailsAndUpdatePage");
            Route::post("update/image", [ProductController::class, "updateImage"])->name('admin#updateImage');
            Route::post("update/product", [ProductController::class, "updateProduct"])->name("admin#updateProduct");
            Route::post("delete/color", [ProductController::class, "deleteColor"])->name("admin#deleteColor");
            Route::Post('delete/spec', [ProductController::class, "deleteSpec"])->name('admin#deleteSpec');
        });

        //Order
        Route::prefix("order")->group(function () {
            Route::get("lists", [OrderManageController::class, 'orderListsPage'])->name("admin#orderListPage");
            Route::post("change/status", [OrderManageController::class, "changeOrderStatus"])->name("admin#changeStatus");
            Route::post("filter", [OrderManageController::class, "filterOrder"])->name("admin#filterOrder");
            Route::get("details/{orderCode}", [OrderManageController::class, "orderDetails"])->name("admin#orderDetails");
        });

        //Managa Contact
        Route::get("contact/list", [ContactController::class, "contactListPage"])->name("admin#contactList");
    });

    //User
    Route::prefix("user")->middleware('userMiddleware')->group(function () {
        Route::get("home", [UserPageController::class, "homePage"])->name("user#home");

        //Profile
        Route::get("profile", [UserProfileController::class, "profilePage"])->name("user#profile");
        Route::post("update/profile", [ProfileController::class, "updateProfile"])->name("user#profileUpdate");
        Route::post("change/Password", [ProfileController::class, "changePassword"])->name("user#changePassword");

        //ProductController
        Route::get("product/details/cart/{id}", [UserProductController::class, "detailsAndAddtoCartPage"])->name('user#detailsAndAddtoCartPage');
        Route::get('cart', [UserProductController::class, "cartPage"])->name('user#cartPage');

        //Order
        Route::post("order", [OrderController::class, "addOrder"])->name("user#order");
        Route::get("order/history", [OrderController::class, "orderHistory"])->name("user#orderHistory");
        Route::get("order/details/{orderCode}", [OrderController::class, "orderDetails"])->name("user#orderDetails");

        //User Action
        Route::post("save/product", [ActionController::class, "saveProduct"])->name("user#saveProduct");
        Route::get("save/product/lists", [ActionController::class, "saveProductLists"])->name("user#saveProductLists");
        Route::post("remove/saveProduct", [ActionController::class, "removeSaveProduct"])->name("user#removeSaveProduct");

        //Rating
        Route::post("add/rating", [ActionController::class, "addRating"])->name("user#addRating");
        Route::post("remove/rating", [ActionController::class, "removeRating"])->name("user#removeRating");
        //Comment
        Route::post("add/comment", [ActionController::class, "addComment"])->name("user#addComment");
        Route::post("remove/comment", [ActionController::class, "removeComment"])->name("user#removeComment");

        //Contact
        Route::get("contact", [ActionController::class, "contactPage"])->name("user#contactPage");
        Route::post("send/message", [ActionController::class, "sendMessage"])->name("user#sendMessage");

        //Visit Count
        Route::get("visitCount", [ActionController::class, "visitCount"])->name("user#visitCount");
    });
});
