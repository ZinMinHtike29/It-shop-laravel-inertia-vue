<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderLists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class OrderController extends Controller
{
    //Add Order
    public function addOrder(Request $request)
    {
        foreach ($request->orders as $order) {
            $data = [
                "product_id" => $order["id"],
                "specification_id" => $order["specifications"]["id"],
                "qty" => $order["count"],
                "order_code" => $request->orderCode,
                "total_price" => $order["count"] * $order["specifications"]["price"]
            ];
            if ($order['colors'] != null) {
                $data['color'] = $order["colors"];
            }
            OrderLists::create($data);
        }
        Order::create([
            "user_id" => Auth::user()->id,
            "order_code" => $request->orderCode,
            "total_price" => $request->totalPrice * 1 + 10
        ]);
        return response()->json(["success" => true], 200);
    }

    //Order History Page
    public function orderHistory()
    {
        $order = Order::select("orders.*", "users.name", "users.phone", "users.email", "users.address")
            ->leftJoin("users", "users.id", "orders.user_id")
            ->where("orders.user_id", Auth::user()->id)
            ->orderBy("orders.id", "desc")
            ->paginate(5);
        return Inertia::render("User/OrderHistory", [
            "orders" => $order
        ]);
    }

    //Order Details
    public function orderDetails($orderCode)
    {
        $orderProduct = OrderLists::with('product.images', 'product.brand', 'product.category', 'product.specifications')->where("order_code", $orderCode)->get();
        return Inertia::render("User/OrderDetails", [
            "orderProducts" => $orderProduct
        ]);
    }
}