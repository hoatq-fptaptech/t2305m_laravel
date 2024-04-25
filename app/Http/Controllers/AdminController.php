<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        return view("admin.page.dashboard");
    }
    public function orders(Request $request){
        $search = $request->get("search");
        $status = $request->get("status");
        $orders = Order::Search($search)->Status($status)
                ->orderBy("id","desc")
                ->paginate(20);
        return view("admin.page.orders",compact('orders'));
    }
    public function detailOrder(Order $order){
        return view("admin.page.detail_order",compact('order'));
    }
    public function confirmOrder(Order $order){
        $order->update(["status"=>Order::STATUS_CONFIRMED]);
        return redirect()->back();
    }

    public function products(Request $request){
        $products = Product::orderBy("id","DESC")->paginate(20);
        return view("admin.page.products",compact('products'));
    }

    public function productCreate(){
        return view("admin.page.product_create");
    }
}
