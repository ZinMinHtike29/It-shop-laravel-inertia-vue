<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderLists;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderManageController extends Controller
{
    //Direct Order List Page
    public function orderListsPage()
    {
        $order = Order::select("orders.*", "users.name", "users.phone", "users.email", "users.address")
            ->leftJoin("users", "users.id", "orders.user_id")
            ->when(request("searchKey"), function ($query) {
                $query->orWhere("order_code", "like", "%" . request('searchKey') . "%")
                    ->orWhere("users.email", "like", "%" . request('searchKey') . "%")
                    ->orWhere("users.name", "like", "%" . request('searchKey') . "%");
            })
            ->orderBy("orders.id", "desc")
            ->paginate(5);
        return Inertia::render("Admin/OrderLists", [
            "orders" => $order
        ]);
    }

    //Change Order Status
    public function changeOrderStatus(Request $request)
    {
        Order::where("order_code", $request->orderCode)->update([
            "order_status" => $request->status
        ]);
        return response()->json(["success" => true], 200);
    }

    //Filter Order With Status
    public function filterOrder(Request $request)
    {
        if ($request->status == null) {
            $order = Order::with("user")->orderBy("id", "desc")->get();
        } else {
            $order = Order::with("user")->where("order_status", $request->status)->orderBy("id", "desc")->get();
        }
        return response()->json(["order" => $order, "success" => true], 200);
    }

    //Order Details
    public function orderDetails($orderCode)
    {
        $orderProduct = OrderLists::with('product.images', 'product.brand', 'product.category', 'product.specifications')->where("order_code", $orderCode)->get();
        return Inertia::render("Admin/OrderDetails", [
            "orderProducts" => $orderProduct
        ]);
    }
}
